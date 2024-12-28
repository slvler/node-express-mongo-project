import registerValidation from "../validation/authValidation.js";
import { user } from "../models/user.js";
import crypto from "crypto";

const register = async (request, res) => {
  const result = registerValidation(request.body);
  console.log(result.error);

  if (result.error) {
    return res.status(422).json({
      status: false,
      errorCause: result.error.name,
      message: result.error.details[0].message,
    });
  }
  try {
    const emailExit = await user.findOne({ email: request.body.email });
    if (!emailExit) {
      const salt = crypto.randomBytes(128).toString("base64");
      const hash = crypto.pbkdf2Sync(
        request.body.password,
        salt,
        10000,
        512,
        "sha512",
      );

      console.log(hash);

      const UserDB = new user({
        email: request.body.email,
        password: hash,
        name: request.body.name,
      });
      const savedUser = await UserDB.save();

      if (savedUser) {
        return res.status(200).json({
          success: true,
          message: "user register succesfull",
        });
      } else {
        return res.status(400).send({
          status: true,
          message: "user register fail",
        });
      }
    } else {
      return res.status(400).send({
        status: false,
        message: "wait",
      });
    }
  } catch (error) {
    return res.status(503).send({
      status: false,
      message: error.message,
    });
  }
};

const login = async (request, response) => {
  try {
    return response.status(200).send({
      status: true,
      message: "burada",
    });
  } catch (error) {}
};

export { register, login };
