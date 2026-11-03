// Jednoduchá Express aplikace – slouží jen jako "obal" pro zastaralé závislosti.
const express = require("express");
const _ = require("lodash");

const app = express();

app.get("/", (req, res) => {
  res.json({ message: "Demo aplikace pro test Trivy Web Scanneru", items: _.range(1, 4) });
});

app.listen(3000, () => console.log("Běží na http://localhost:3000"));
