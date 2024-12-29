import Joi from "joi";

const createValidation = (data) => {
    const cartCreateScheme = Joi.object({
        product_id: Joi.string().required(),
        quantity: Joi.number().integer().required(),
    });
    return cartCreateScheme.validate(data);
};

export { createValidation };
