var data= {
    chatinit:{
        title: ["Hello <span class='emoji'> &#128075;</span>","We are H-Bionic team","How can we help you?"],
        options: ["technical sport & questions 🤖","shipping problems 🚛","payment 💳"]
    },
    technical: {
        title:["Please select a category"],
        options:[
            '1 / My prosthetic arm does not work',
            '2 / My prosthetic arm has stopped moving',
            '3 / My prosthetic arm has been broken',
            "4 / Can a prosthetic arm get wet?",
            "5 / Can I wear the prosthetic arm all day?",
            "6 / How heavy is a prosthetic arm?"
        ],
        url : {}
    },
    '1':{
        title:["Please select a category"],
        options:[ 
            '1_1 / The Heat sensor is not working',
            '1_2 / The Blode preshur is not working',
            '1_3 / The Prosthetic arw is not moving'
        ],
        url : {}
    },
    '1_1':{
        title:["The heat sensor has to touch the object directly "," is it still not responding"],
        options:[ 
            'YES',
            'NO its working'
        ],
        url : {}
    },
    yes:{ 
        title:[
            "In this case you can be transferd to a live chat to talk with one of our workers by pressing  Livechat"
        ],
        options:[],
        url : {
            more:"../User_LiveCaht/public/index.html"
        }
    },
    no:{ 
        title:["Happy to help 😊"],
        options:[],
        url : {}
    },
    '1_2':{ 
        title:["The blood pressure has to touch the skin directly ","is it still not responding"],
        options:[ 
            'YES',
            'NO its working'
        ],
        url : {}
    },
   '1_3':{ 
        title:["The muscle sensor has to touch the screen directly "," is it still not responding"],
        options:[ 
            'YES',
            'NO its working'
        ],
        url : {}
    },
    '2':{
        title:["Is the muscle sensor connected properly to your arm ?"],
        options:[ 
            'YES',
            'NO its working'
        ],
        url : {}
    },
    '3':{
        title:["In this situation you will have to go to the nearest location of our company to have it fixed"],
        options:[],
        url : {}
    },
    '4':{
        title:["Unfortunately not without a cover for the arm to stop the water from fring the scots"],
        options:[],
        url : {}
    },
    '5':{
        title:["It is best to be taken off when going to bed"],
        options:[],
        url : {}
    },
    '6':{
        title:["The prosthetic arm is based on your design the more fechar you have on it the heaviest it will get"],
        options:[],
        url : {}
    },
    shipping: {
        title:["Please select a category"],
        options:[
            "S1 / When will my shipment arrive?",
            "S2 / The shipmen item has been damiged",
            "S3 / the shipmen did not arive"
        ],
        url : {}
    },
    S1:{
        title:["Will have it chiket in our database and will contact you right away"],
        options:[ 
        ],
        url : {}
    },
    S2:{
        title:["We are terribly sorry for the inconvenience and will send another one in no time"],
        options:[],
        url : {}
    },
    S3:{
        title:["We are terribly sorry for the inconvenience and will see to the situation"],
        options:[],
        url : {}
    },
    payment:{
        title:["How can you pay","We accept CREDIT CARD "," VISA "," CASH "],
        options:[],
        url : {}
    },
}

var div = document.getElementById("init");
var display = 0;

// to desplay and hide the Chat now but
function hideShow(){
    if(display == 1){
        div.style.display = 'block';
        display = 0;
    }else{
        div.style.display = 'none';
        display = 1;
    }
}

document.getElementById("init").addEventListener("click",showChatBot);
var cbot= document.getElementById("chat-box");

var len1= data.chatinit.title.length;

// to change the css code from none to block
function showChatBot(){
    console.log(this.innerText);
    var display = 0;
    if(this.innerText=='Chat Now'){
        document.getElementById('test').style.display='block';
        initChat();
    }
    else{
        location.reload();
    }
}

// berform a  daly on th intilayzation of the chat 
function initChat(){
    j=0;
    cbot.innerHTML='';
    for(var i=0;i<len1;i++){
        setTimeout(handleChat,(i*500));
    }
    setTimeout(function(){
        showOptions(data.chatinit.options)
    },((len1+1)*500))
}

// desplay teh masseges in sequanse  after the titeled masseges is desplayd

var j=0;
function handleChat(){
    console.log(j);
    var elm= document.createElement("p");
    elm.innerHTML= data.chatinit.title[j];
    elm.setAttribute("class","msg");
    cbot.appendChild(elm);
    j++;
    handleScroll();
}

// to allow the masseges to be clickabul
function showOptions(options){
    for(var i=0;i<options.length;i++){
        var opt= document.createElement("span");
        var inp= '<div>'+options[i]+'</div>';
        opt.innerHTML=inp;
        opt.setAttribute("class","opt");
        opt.addEventListener("click", handleOpt);
        cbot.appendChild(opt);
        handleScroll();
    }
}

// to handel the user choice by selecting the first word 
function handleOpt(){
    console.log(this);
    var str= this.innerText;
    var textArr= str.split(" ");
    var findText= textArr[0];
    
    document.querySelectorAll(".opt").forEach(el=>{
        el.remove();
    })
    var elm= document.createElement("p");
    elm.setAttribute("class","test");
    var sp= '<span class="rep">'+this.innerText+'</span>';
    elm.innerHTML= sp;
    cbot.appendChild(elm);

    console.log(findText.toLowerCase());
    var tempObj= data[findText.toLowerCase()];
    handleResults(tempObj.title,tempObj.options,tempObj.url);
}

// to desply the next set of masseges based on the user choice
function handleDelay(title){
    var elm= document.createElement("p");
        elm.innerHTML= title;
        elm.setAttribute("class","msg");
        cbot.appendChild(elm);
}
function handleResults(title,options,url){
    for(let i=0;i<title.length;i++){
        setTimeout(function(){
            handleDelay(title[i]);
        },i*500)
        
    }

    const isObjectEmpty= (url)=>{
        return JSON.stringify(url)=== "{}";
    }

    if(isObjectEmpty(url)==true){
        console.log("having more options");
        setTimeout(function(){
            showOptions(options);
        },title.length*500)
        
    }
    else{
        console.log("end result");
        setTimeout(function(){
            handleOptions(options,url);
        },title.length*500)
        
    }
}

//to handel the URL of the live chat 
function handleOptions(options,url){
    for(var i=0;i<options.length;i++){
        var opt= document.createElement("span");
        var inp= '<a class="m-link" href="'+url.link[i]+'">'+options[i]+'</a>';
        opt.innerHTML=inp;
        opt.setAttribute("class","opt");
        cbot.appendChild(opt);
    }
    var opt= document.createElement("span");
    var inp= '<a class="m-link" href="'+url.more+'">'+'LiveChat<br></a>';

    const isObjectEmpty= (url)=>{
        return JSON.stringify(url)=== "{}";
    }

    console.log(isObjectEmpty(url));
    console.log(url);
    opt.innerHTML=inp;
    opt.setAttribute("class","opt link");
    cbot.appendChild(opt);
    handleScroll();
}
 
function handleScroll(){
    var elem= document.getElementById('chat-box');
    elem.scrollTop= elem.scrollHeight;
}

let toggleBtn = document.getElementsByClassName("toggle-menu");
let tlinks = document.getElementsByClassName("links");
toggleBtn.onclick = function(){
    tlinks.classList.toggle("open");
}
