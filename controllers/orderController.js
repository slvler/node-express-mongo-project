import Order from '../models/orderModel.js';

const index = async (req, res) => {

   try{
       const result = await Order.find({});

       return res.status(200).json({
           status: true,
           message: 'successful',
           data: result
       })
   }catch (error)
   {
       return res.status(503).json({
           status: false,
           message: error.message,
       });
   }
}

export { index }