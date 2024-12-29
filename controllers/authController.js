import {
  registerValidation,
  loginValidation,
} from "../validation/authValidation.js";
import User from "../models/userModel.js";
import jwt from "jsonwebtoken";
import bcrypt from "bcrypt";
import config from '../config/config.js'

const register = async (req, res) => {
  const result = registerValidation(req.body);

  if (result.error) {
    return res.status(422).json({
      status: false,
      errorCause: result.error.name,
      message: result.error.details[0].message,
    });
  }
  try {
    const emailExit = await User.findOne({ email: req.body.email });
    if (!emailExit) {

      const salt = await bcrypt.genSalt(config.SALT);
      const hash = await bcrypt.hash(req.body.password, salt);

      const UserDB = new User({
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

    const result = await User.findOne({
      email: req.body.email
    });

    if (!result){
      res.status(401).send({
        status: false,
        message: 'Invalid Email or Password',
      });
    }else{

      const passwordControl = await bcrypt.compare(req.body.password, result.password);

      if (!passwordControl){
        res.status(401).send({
          status: false,
          message: 'Invalid Email or Password1',
        });
      }

      const token = jwt.sign(
          {
            _id: result._id,
            name: result.name,
            email: result.email,
            isAdmin: result.isAdmin,
          },
          config.JWT_SECRET
      );

      return res.status(200).send({
        status: true,
        message: "successful",
        _id: result._id,
        name: result.name,
        email: result.email,
        isAdmin: result.isAdmin,
        token: token,
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
