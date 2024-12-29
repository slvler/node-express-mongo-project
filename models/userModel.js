import mongoose from "mongoose";

const userSchema = new mongoose.Schema(
    {
      name: { type: String, required: true, max: 18, min: 3 },
      surname: { type: String, max: 18, min: 3, },
      email: { type: String, required: true, max: 255, min: 6, },
      password: { type: String, required: true, max: 255, min: 6, },
      isAdmin: { type: Boolean, required: true, default: false }
    },
    { timestamps: true }
);

const User = mongoose.model("User", userSchema);
export default User;