import express from "express";
import {create, index, show, destroy} from "../controllers/productController.js";

const router = express.Router();

router.route("/").get(index);
router.route("/:id").get(show);
router.route("/").post(create);
router.route("/:id").delete(destroy);

export default router;
