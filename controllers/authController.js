import {
  registerValidation,
  loginValidation,
} from "../validation/authValidation.js";
import { user } from "../models/user.js";
import crypto from "crypto";
import jwt from "jsonwebtoken";
import bcrypt from "bcrypt";

const register = async (req, res) => {
  const result = registerValidation(req.body);
  console.log(result.error);

  if (result.error) {
    return res.status(422).json({
      status: false,
      errorCause: result.error.name,
      message: result.error.details[0].message,
    });
  }
  try {
    const emailExit = await user.findOne({ email: req.body.email });
    if (!emailExit) {
      // const salt = crypto.randomBytes(128).toString("base64");
      // const hash = crypto.pbkdf2Sync(
      //   request.body.password,
      //   salt,
      //   10000,
      //   512,
      //   "sha512",
      // );

      const salt = await bcrypt.genSalt(10);
      const hash = await bcrypt.hash(req.body.password, salt);

      const UserDB = new user({
        email: req.body.email,
        password: hash,
        name: req.body.name,
      });
      const savedUser = await UserDB.save();

      if (savedUser) {
        return res.status(200).json({
          success: true,
          message: "user register successful",
        });
      } else {
        return res.status(400).json({
          status: true,
          message: "user register fail",
        });
      }
    } else {
      return res.status(400).json({
        status: false,
        message: "wait",
      });
    }
  } catch (error) {
    return res.status(503).json({
      status: false,
      message: error.message,
    });
  }
};

const login = async (req, res) => {
  const result = loginValidation(req.body);
  if (result.error) {
    return res.status(422).json({
      status: false,
      message: result.error.details[0].message,
    });
  }

  try {
    const result = user.findOne({ email: req.body.email });

    if (result) {
      const token = jwt.sign(
        { _id: result._id, email: req.body.email },
        process.env.TOKEN_SECRET,
      );

      return res.status(200).send({
        status: true,
        message: "successful",
        token: token,
      });
    } else {
      return res.status(500).send({
        status: false,
        message: "error user",
      });
    }
  } catch (error) {
    return res.status(503).send({
      status: false,
      message: error.message,
    });
  }
};

export { register, login };
