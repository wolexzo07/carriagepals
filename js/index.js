function showalert(msg){
Toastify({
  text: msg,
  duration: 3000,
  //destination: "https://github.com/apvarun/toastify-js",
  newWindow: true,
  close: true,
  gravity: "top", // `top` or `bottom`
  position: "right", // `left`, `center` or `right`
  stopOnFocus: true, // Prevents dismissing of toast on hover
  style: {
    //background: "linear-gradient(to right, #00b09b, #96c93d)",
    background: "white",
	color:"green",
  },
  onClick: function(){} // Callback after click
}).showToast();
}


