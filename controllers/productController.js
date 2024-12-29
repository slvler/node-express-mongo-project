import Product from '../models/productModel.js'
import { createValidation, updateValidation } from "../validation/productValidation.js";
import slug from 'slug'

const index = async (req, res) => {
    const products = await Product.find();
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
        const newItem = new Product({
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
        const item = await Product.findById({_id: req.params.id});
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

const update = async (req, res) => {

    const item = await Product.findById({_id: req.params.id});

    const result = updateValidation(req.body)
    if (result.error) {
        return res.status(422).json({
            status: false,
            message: result.error.details[0].message,
        });
    }

    if (item){
        let slugTxt;

        if (req.body.name){
            slugTxt = slug(req.body.name);
        }

        const update = await Product.findByIdAndUpdate(
            { _id: req.params.id },
            {
                $set:{
                    name: req.body.name,
                    description: req.body.description,
                    price: req.body.price,
                    stock: req.body.stock,
                    status: req.body.status,
                    slug: slugTxt ?? item.slug
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

    }else{
        return res.status(404).send({
            message: "product not found",
            status: false
        });
    }

    return res.status(200).json({
        status: true,
        message: "successful",
        data: req.params.id,
        item: item
    })
}



const destroy = async(req, res) => {
    try{
        const item = await Product.findOneAndDelete({_id: req.params.id});
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


export { index, create, show, destroy, update }