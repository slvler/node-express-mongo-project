import Joi from "joi";

const createValidation = (data) => {
    const createScheme = Joi.object({
        name: Joi.string().min(6).max(255).required(),
        description: Joi.string().min(6).max(255).required(),
        price: Joi.number().min(0).required(),
        stock: Joi.number().min(0).required(),
        status: Joi.string().valid('ACTIVE','PASSIVE').required()
    });
    return createScheme.validate(data);
};

export { createValidation };