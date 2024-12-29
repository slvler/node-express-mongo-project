import mongoose from "mongoose"

const { Schema } = mongoose

const productSchema = new Schema(
    {
        name: { type: String, required: true },
        description: { type: String, required: true },
        slug: { type: String, slug: "title", required: true },
        price: { type: Number, },
        stock: { type: Number, },
        status: { type: String, enum: ['ACTIVE','PASSIVE'], default: 'ACTIVE'}
    },
    {
        timestamps: true
    }
)

const Product = mongoose.model("Product", productSchema);
export default Product;