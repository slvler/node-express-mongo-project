import express from "express";
import {index, create} from "../controllers/cartController.js";

import { isAuth } from "../middlewares/isAuth.js"

const router = express.Router();

router.route("/").get(isAuth, index);
router.route("/").post(isAuth, create);

export default router;


