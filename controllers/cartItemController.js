import cartItemModel from "../models/cartItemModel.js";
import productModel from "../models/productModel.js";
import CartItem from "../models/cartItemModel.js";

const update = async (req, res) => {

    try {
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
                message: "update successful",
                data: update
            });

        }else{
            return res.status(404).send({
                status: false,
                message: "update failed"
            });
        }
    }catch (error) {
        return res.status(503).json({
            status: false,
            message: error.message,
        });
    }
}

const destroy = async (req, res) => {
    try{
        const item = await cartItemModel.findOneAndDelete({_id: req.params.id});
        if (item){
            return res.status(200).send({
                status: true,
                message: "cart item delete"

            });
        }else{
            return res.status(404).send({
                status: false,
                message: "cart item not found"
            });
        }
    }catch (error) {
        return res.status(503).json({
            status: false,
            message: error.message,
        });
    }
}

export {update, destroy}