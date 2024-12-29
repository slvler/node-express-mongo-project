import mongoose from "mongoose";

const { Schema } = mongoose

const cartSchema = new Schema(
    {
        user: { type: mongoose.Schema.Types.ObjectId, ref: 'User', required: true },
        status: { type: String, enum : ['ACTIVE','PASSIVE'], default: 'ACTIVE' }
    },
    { timestamps: true }
)

const Cart = mongoose.model("Cart", cartSchema);
export default Cart;

