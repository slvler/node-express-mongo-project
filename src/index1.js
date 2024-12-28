import express from "express";

const app = express();

const PORT = process.env.PORT || 3000;

app.get("/", (request, response) => {
  response.status(200).send({
    message: "success",
    status: true,
  });
});

app.get("/api/users", (request, response) => {
  response.send([
    { id: 1, name: "John doe", age: 30 },
    { id: 2, name: "JH doe", age: 31 },
    { id: 3, name: "Jon doe", age: 32 },
    { id: 4, name: "Jo doe", age: 33 },
    { id: 5, name: "J doe", age: 34 },
  ]);
});

app.get("/api/users/:id/:username", (request, response) => {
  console.log(request.params);
  console.log(request.params.id);
  console.log(request.params.username);
  const parseId = parseInt(request.params.id);
  const userName = request.params.username;

  if (isNaN(parseId))
    return response.status(400).send({
      message: "bad request",
    });
  response.send({
    id: parseId,
    username: userName,
  });
});

app.get("/api/products", (request, response) => {
  console.log(request.query);
  response.send({
    filter: request.query.filter,
    paginate: request.query.paginate,
    sort: request.query.sort,
  });
});

app.listen(PORT, () => {
  console.log(`Listening on port ${PORT}`);
});
