import express from "express";
import {create, index} from "../controllers/productController.js";

const router = express.Router();

router.route("/").get(index);
router.route("/").post(create);

export default router;
