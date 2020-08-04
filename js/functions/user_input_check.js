//This function checks whether there is a valid input from the user
//If it is not, will return an error
//Otherwise, will let the process, from where this function is called, continue...
function checkform() {
    if (document.getElementsByName("user")[0].value === "")
    {
        alert("Invalid input");
        return false;
    }
}