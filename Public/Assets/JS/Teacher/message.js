const chatCont = document.getElementById("chat-content");
const subContOne = document.getElementById("sub-cont-1");
const subContTwo = document.getElementById("sub-cont-2");
const type = document.getElementById("type-1");
const sendButton = document.getElementById("act-1");


sendButton.addEventListener('click',()=>{
    //get a clone of the subcontentonce
    const clone = subContTwo.cloneNode(true);
    //appending the clone to the chat content to make it visible for the DOM
    chatCont.appendChild(clone);

    //replace the value of the 3rd child node (h3) with the input value
    const message = clone.querySelector("#chat-2");
    if(message){
        
        message.textContent = type.value;
        console.log(message.textContent);
    }
    type.value = '';
})
