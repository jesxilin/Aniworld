document.addEventListener('DOMContentLoaded', bgChange())
var word = document.getElementById('dom-target').innerText
console.log("word: ", word)
//var url = "https://animechan.vercel.app/api/random"

if(!isBlank(word) && word != null) {
    animeArray = new Array();
    $.ajax({
        url:"https://animechan.vercel.app/api/available/anime",
        type:"GET",
        success:function(msg){
            animeArray = msg.map(name => name.toLowerCase())
            console.log("ANIME ARRAY: ", animeArray)
            // if exists in array, then get it 
            if(animeArray.indexOf(word.trim().toLowerCase()) !== -1){
                $.ajax({
                    method: "GET",
                    url: "https://animechan.vercel.app/api/quotes/anime?title=" + word.trim(),
                })
                .done(function (results){
                    // get anime
                    displaySearchAnime(results)
                })
                .fail(function (){
                    console.log("ERROR")
                })
            } else {
                // WORD DOES NOT EXIST in array, should just keep getting random anime
                $.ajax({
                    method: "GET",
                    url: "https://animechan.vercel.app/api/random",
                })
                .done(function (results){
                    displayAnime(results)
                })
                .fail(function (){
                    console.log("ERROR")
                })
            }
        },
        dataType:"json"
    });
} else {
    $.ajax({
        method: "GET",
        url: "https://animechan.vercel.app/api/random",
    })
    .done(function (results){
        if(!isBlank(word)){
            // get anime
            displaySearchAnime(results)
        } else {
            displayAnime(results)
        }
    })
    .fail(function (){
        console.log("ERROR")
    })
}


// For displaying random anime quotes
function displayAnime(results){
    console.log(results)
    let htmlString = results.quote + "  -  " + results.anime
    if(htmlString){
        document.getElementById('randomFact').innerHTML = htmlString
    }
}

// For displaying searched anime quotes
function displaySearchAnime(results){
    getIndex = getRandomInt(results.length)
    let htmlString = results[getIndex].quote + "  -  " + results[getIndex].anime
    if(htmlString){
        document.getElementById('randomFact').innerHTML = htmlString
    }
}

// For getting random number
function getRandomInt(max) {
    return Math.floor(Math.random() * max);
}

// To dynamically change the background
function bgChange(){
    bgArray = ["https://i.pinimg.com/originals/c2/44/5d/c2445dd759cf52be7e37d294c62d730e.gif", "https://c.tenor.com/hasFbR6_mVoAAAAd/the-garden-of-words-kotonoha-no-niwa.gif", "https://data.whicdn.com/images/287632738/original.gif", "https://animesher.com/orig/1/161/1617/16177/animesher.com_anime-scenery-gif-kotonoha-no-niwa-1617736.gif", "https://i.gifer.com/Q1K1.gif"]
    getIndex = getRandomInt(bgArray.length)
    console.log(bgArray[getIndex])
    document.body.style.backgroundImage = `url('${bgArray[getIndex]}')`
}

// check if string is blank
function isBlank(str) {
    return (!str || /^\s*$/.test(str));
}

