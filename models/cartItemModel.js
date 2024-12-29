import mongoose from "mongoose";

const { Schema } = mongoose

const cartItemSchema = new Schema(
    {
        cart: { type: mongoose.Schema.Types.ObjectId, ref: 'Cart', required: true },
        product: { type: mongoose.Schema.Types.ObjectId, ref: 'Product', required: true },
        quantity: { type: Number },
        price: { type: Number },
        subtotal: { type: Number },
    },
    { timestamps: true }
)

const CartItem = mongoose.model("CartItem", cartItemSchema);
export default CartItem;

