import express from "express";
import {index} from "../controllers/orderController.js";
import { isAuth } from "../middlewares/isAuth.js"
import isAdmin from "../middlewares/isAdmin.js";

const router = express.Router();

router.route("/").get(isAuth, isAdmin, index);

export default router;


