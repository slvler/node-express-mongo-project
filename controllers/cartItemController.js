import cartItemModel from "../models/cartItemModel.js";
import product from "../models/productModel.js"
import productModel from "../models/productModel.js";
import CartItem from "../models/cartItemModel.js";


const update = async (req, res) => {

    const cartItem = await cartItemModel.findById(req.params.id)

    if (cartItem){

        const product = await productModel.findById(cartItem.product);

        const subTotal = req.body.quantity * product.price;

        const update = await CartItem.findByIdAndUpdate(
            { _id: cartItem._id },
            {
                $set:{
                    quantity: req.body.quantity,
                    price: product.price,
                    subtotal: subTotal
                }
            });

        return res.status(200).json({
            status: true,
            data: update
        });

    }else{
        return res.status(404).send({
            message: "update failed",
            status: false
        });
    }



    const update = await cartItemModel.findByIdAndUpdate(
        { _id: req.params.id },
        {
            $set:{
                quantity: req.body.description,
            }
        });

    if (update){

        return res.status(200).json({
            status: true,
            message: "update successful",
            data: update
        });
    }else{
        return res.status(404).send({
            message: "update failed",
            status: false
        });
    }

    return res.status(200).json({
        data: req.params.id,
        data1: req.body
    });
}

const destroy = (req, res) => {

}

export {update, destroy}