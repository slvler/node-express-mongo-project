import express from "express";
import dotenv from "dotenv";
import connectDB from "./db/database.js";
import bodyParser from "body-parser";
//router
import auth from "./routes/auth.js";
import product from "./routes/product.js";
import cart from './routes/cart.js'
import cartItem from "./routes/cartItem.js";
import order from "./routes/order.js"

const app = express();

dotenv.config();
connectDB();
app.use(express.json());
app.use(bodyParser.urlencoded({ extended: true }));

app.use("/api/v1/auth", auth);
app.use("/api/v1/products", product);
app.use("/api/v1/cart", cart)
app.use("/api/v1/cart-item", cartItem)
app.use("/api/v1/order", order)

const PORT = process.env.PORT || 3000;

app.listen(PORT, () => {
  console.log(`Server listen at port ${PORT}`);
});
