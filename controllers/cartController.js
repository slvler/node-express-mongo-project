import Cart from '../models/cartModel.js';
import CartItem from "../models/cartItemModel.js";
import Product from '../models/productModel.js'
import { createValidation } from "../validation/cartValidation.js";
import mongoose from "mongoose";

const index = async (req, res) => {
    const result = await Cart.find({
        user: req.user._id
    })
    if (result){
        return res.status(200).json({
            status: true,
            message: "basket imaging process successful",
            data: result
        })
    }else{
        return res.status(404).json({
            status: false,
            message: "cart not found"
        })
    }
}
const create = async (req, res) => {
    const result = createValidation(req.body)

    if (result.error) {
        return res.status(422).json({
            status: false,
            message: result.error.details[0].message,
        });
    }

    try{
        const product = await Product.findById(req.body.product_id);

        if (!product){
            return res.status(404).json({
                status: false,
                message: "product is not found"
            });
        }

        const cart = await Cart.findOne({
            user: req.user._id,
            status: "ACTIVE"
        })

        if (!cart){
            const newCart = new Cart({
                user: req.user._id,
                status: 'ACTIVE'
            });

            const savedCart = await newCart.save();

            const subTotal = req.body.quantity * product.price;

            const newCartItem = new CartItem({
                cart: savedCart._id,
                product: product._id,
                quantity: req.body.quantity,
                price: product.price,
                subtotal: subTotal
            });

            const savedCardItem = await newCartItem.save();

            return res.status(200).json({
                status: true,
                message: 'product successfully added to card',
                cart: savedCart,
                cartItem: savedCardItem,
            });
        }else{
            const cartItem = await CartItem.findOne({
                cart: cart._id,
                product: req.body.product_id,
            });

            if (!cartItem){

                const subTotal = req.body.quantity * product.price;
                const newCartItem = new CartItem({
                    cart: cart._id,
                    product: product._id,
                    quantity: req.body.quantity,
                    price: product.price,
                    subtotal: subTotal
                });
                const savedCardItem = await newCartItem.save();

                return res.status(200).json({
                    status: true,
                    message: 'product successfully added to card',
                    data: savedCardItem
                });

            }else{
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
                    message: "item in cart updated successfully",
                    cartItem: update
                });
            }
        }
    }catch (error)
    {
        return res.status(503).send({
            status: false,
            message: error.message,
        });
    }
}

export { index, create }