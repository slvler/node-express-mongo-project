import mongoose from "mongoose";

const connectDB = async () => {
  try {
    await mongoose
      .connect(`mongodb://root:example@mongo:27017?authSource=admin`)
      .then(() => console.log("succesfully connected to db"))
      .catch((e) => console.log(e));
  } catch (error) {
    console.log(error);
  }
};

export default connectDB;
