import mongoose from "mongoose";

const { Schema } = mongoose

const orderSchema = new Schema(
    {
        user: { type: mongoose.Schema.Types.ObjectId, ref: 'User', required: true },
        total_amount: { type: Number, required: true },
        status: { type: String, enum : ['ACTIVE','PASSIVE'], default: 'ACTIVE' }
    },
    { timestamps: true }
)

const Order = mongoose.model("Order", orderSchema);
export default Order;

