import express from "express";
import {update, destroy} from "../controllers/cartItemController.js";

import { isAuth } from "../middlewares/isAuth.js"

const router = express.Router();

router.route("/items/:id").put(isAuth, update);
router.route("/items/:id").delete(isAuth, destroy);

export default router;


