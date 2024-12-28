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
        return res.status(201).send({
            message: "product create successful",
            status: true,
            data: newItem
        })
    } else {
        return res.status(400).send({
            status: true,
            message: "product register fail",
        });
    }

}


export { index, create }