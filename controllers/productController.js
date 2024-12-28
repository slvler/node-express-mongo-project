import { product } from '../models/product.js'
import { createValidation } from "../validation/productValidation.js";
import slug from 'slug'

const index = async (req, res) => {
    const products = await product.find();
    res.status(200).json({
        status: true,
        data: products,
        message: 'successful'
    })
}

const create = async (req, res) => {
    const result = createValidation(req.body)
    if (result.error) {
        return res.status(422).json({
            status: false,
            message: result.error.details[0].message,
        });
    }
    let slugTxt = slug(req.body.name);

    try{
        const newItem = new product({
            name: req.body.name,
            description: req.body.description,
            price: req.body.price,
            stock: req.body.stock,
            status: req.body.status,
            slug: slugTxt
        });

        const savedProduct = newItem.save();

        if (savedProduct) {
            return res.status(201).json({
                message: "product create successful",
                status: true,
                data: newItem
            })
        } else {
            return res.status(400).json({
                status: true,
                message: "product register fail",
            });
        }
    }catch (error) {
        return res.status(503).json({
            status: false,
            message: error.message,
        });
    }
}

const show = async (req, res) => {
    try{
        const item = await product.findById({_id: req.params.id});
        if (item){
            return res.status(200).send({
                message: "product show",
                status: true,
                data: item
            });
        }else{
            return res.status(404).send({
                message: "product not found",
                status: false
            });
        }
    }catch (error) {
        return res.status(503).json({
            status: false,
            message: error.message,
        });
    }
}

const destroy = async(req, res) => {
    try{
        const item = await product.findOneAndDelete({_id: req.params.id});
        if (item){
            return res.status(200).send({
                message: "product delete",
                status: true
            });
        }else{
            return res.status(404).send({
                message: "product not found",
                status: false
            });
        }
    }catch (error) {
        return res.status(503).json({
            status: false,
            message: error.message,
        });
    }
}


export { index, create, show, destroy }