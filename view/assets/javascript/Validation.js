function validateName(id) {
    let name = document.getElementById(id);
    let n = name.value;
    if(name.value.length < 3) {
        name.setCustomValidity('Name should have at least 3 letters.');
        return false;
    }
    if(!/^[a-zA-Z]+$/.test(name.value)) {
    	name.setCustomValidity('Name can only have letters.');
    	return false;
    }
    name.setCustomValidity('');
    return true;
}
function validatePassword(id) {
    let pass = document.getElementById(id);
    let v = pass.value;
    let a = v.toLowerCase();
    if(v.length < 6) {
        pass.setCustomValidity('Password is too short (At least 6 length)');
        return false;
    }
    if(v === a) {
        pass.setCustomValidity('Password should have at least 1 upper case letter.');
        return false;
    }
    if(!/\d/.test(v)) {
        pass.setCustomValidity('Password should have at least 1 number.');
        return false;
    }
    pass.setCustomValidity('');
    return true;
}