fetch("https://webring.yesterweb.org/webring.json")
    .then(function(response) {
        return response.json();
    })
    .then(function(data) {
        appendData(data);
    })
    .catch(function(err) {
        console.log("error: " + err);
    });

function appendData(data) {

    var random = Math.floor(Math.random() * data.length);

    var name = data[random].name;
    var url = data[random].url;
    var owner = data[random].owner;

    console.log(name, url, owner);
    $('.webring').append("<a href='" + url + "' target='_blank'>" + name + "</a>");

}