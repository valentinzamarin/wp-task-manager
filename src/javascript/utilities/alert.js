const alert = ( msg ) => {
    let alert = document.createElement('div');
    alert.className = 'alert alert-success fixed-top mt-5 container-sm';
    alert.textContent = msg;
    document.body.appendChild( alert );

    setTimeout( () => {
        alert.remove();
    }, 3000 );
}

export default alert;