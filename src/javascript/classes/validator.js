export default class formValidator{
    constructor( form ) {
        this.form = form;
    }

    isValid() {
        this.form.querySelectorAll( '.is-required' ).forEach( req => {
            if( req.value == '' ) {
                req.classList.add( 'is-invalid' );
            } else {
                req.classList.remove( 'is-invalid' );
            }
        })

        let array = Array.from(this.form.querySelectorAll(".is-required"));

        let isValid = array.every((item) => {
            return item.value !== '';
        })

        return isValid;
    }
}