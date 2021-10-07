function generateMap() {
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "ajax.php", true);
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let ob;
            ob = JSON.parse(this.responseText);
            let map = document.getElementById("wykresMap");
            let w, h;
            let id = document.querySelector("img").id;
            let x = id.indexOf("x");
            w = id.substring(0, x);
            h = id.substring(x + 1);
            let width = w;
            let height = h;
            let startW = parseInt(width) * 0.085;
            let startH = parseInt(height) * 0.15;
            let chartWidth = parseInt(width) * 0.85;
            let chartHeight = parseInt(height) * 0.58;
            let rectWidth = chartWidth / 29;
            let rectHeight = chartHeight / 6;
            for (let i = 0; i < ob.length; i++) {
                let area = document.createElement("area");
                if (ob[i]["temperature"] == 0 || ob[i]["temperature"] == 1) {
                    let day = ob[i]["day"];
                    let pointH = startH + chartHeight;
                    let pointW = startW + (day * rectWidth);
                    area.shape = "circle";
                    area.coords = String(pointW) + "," + String(pointH) + ",4";
                    area.style.cursor = "pointer";
                    area.id = ob[i]["day"];
                    map.appendChild(area);
                }
                else {
                    let day = ob[i]["day"];
                    let temperature = ob[i]["temperature"];
                    let diff = 37.2 - temperature;
                    let pointH = startH + (diff / 0.2) * rectHeight;
                    let pointW = startW + (day * rectWidth);
                    area.shape = "circle";
                    area.coords = String(pointW) + "," + String(pointH) + ",4";
                    area.style.cursor = "pointer";
                    area.id = ob[i]["day"];
                    map.appendChild(area);
                }
                area.addEventListener("click", function () {
                    let id;
                    id = this.id;
                    document.getElementById("overlay").style.display = "block";
                    let save = document.getElementById("save");
                    let ill = document.getElementById("ill");
                    let none = document.getElementById("none");
                    let cancel = document.getElementById("cancel");
                    save.onclick = function () {
                        let temperature = parseFloat(document.getElementById("number").value);
                        if (temperature >= 36 && temperature <= 37.2)
                            setData(temperature, id);
                        document.getElementById("overlay").style.display = "none";
                    };
                    ill.onclick = function () {
                        setData(0, id);
                        document.getElementById("overlay").style.display = "none";
                    };
                    none.onclick = function () {
                        setData(1, id);
                        document.getElementById("overlay").style.display = "none";
                    };
                    cancel.onclick = function () {
                        document.getElementById("overlay").style.display = "none";
                    };
                }, false);
            }
        }
    };
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("f=1");
}
function setData(t, id) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "ajax.php", true);
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let map = document.getElementById("wykresMap");
            map.innerHTML = "";
            //src = wykres.php?w=800&h=300
            let w, h;
            let img = document.querySelector("img");
            let id = img.id;
            let x = id.indexOf("x");
            w = id.substring(0, x);
            h = id.substring(x + 1);
            let src = "wykres.php?w=" + String(w) + "&h=" + String(h) + "&id=" + String(Math.random());
            img.src = src;
            generateMap();
        }
    };
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("f=2&t=" + t + "&d=" + id);
}
generateMap();
