//jshint esversion:6

const express = require("express");
const bodyParser = require("body-parser");
const ejs = require("ejs");
const mongoose = require("mongoose");
const _ = require("lodash");
const path = require("path");
var mongodb = require('mongodb');
var app = express();
var exphbs  = require('express-handlebars');
app.set('views', path.join(__dirname,'/views/'));
var router = express.Router;
//app.set('view engine', 'ejs');
app.engine('html', require('ejs').renderFile);
 app.set('view engine', 'html');
app.use(bodyParser.json())
app.use(bodyParser.urlencoded({extended: true}));
app.use(express.static("public"));
mongoose.connect("mongodb+srv://sankirtana_02:edignite2020@cluster0-2n9ll.mongodb.net/test?retryWrites=true&w=majority",{ useNewUrlParser: true,useUnifiedTopology: true },function(err){
  if(!err){
    console.log("connected to mongodb")
  }
  else{
    console.log(err);
  }
});
app.listen(4000,()=>{
  console.log("server started on port 4000");
});
var userinfoSchema= new mongoose.Schema({
  name:{
    type: String
  },
  email:{
    type: String
  },
  phone:{
    type: String
  },
  occ:{
    type: String
  },
  work:{
    type: String
  },
  intro:{
    type: String
  },
  hi:{
    type: String
  },
});
mongoose.model('Userinfo',userinfoSchema);
const Userinfo = mongoose.model('Userinfo');
app.get("/compose",(req,res)=>{
  res.render('compose');
});
module.exports = router;
app.post("/compose",(req,res)=>{
  insertRecord(req,res);
});
function insertRecord(req,res){
  var userinfo = new Userinfo;
  userinfo.name=req.body.name;
  userinfo.email=req.body.email;
  userinfo.phone=req.body.phone;
  userinfo.occ=req.body.occ;
  userinfo.work=req.body.work;
  userinfo.intro=req.body.intro;
  userinfo.hi=req.body.hi;
  userinfo.save((err,doc)=>{
    if(!err){
      res.redirect('/compose');
    }
    else{
      console.log("error");
    }
  });
}
app.get("/",function(req,res){
   res.render("home");
});
app.get("/About",function(req,res){
  res.render("about");
});
app.get("/contact",function(req,res){
  res.render("contact");
});
app.get("/feedback",function(req,res){
  res.render("feedback");
});
app.get("/team",function(req,res){
  res.render("team");
});