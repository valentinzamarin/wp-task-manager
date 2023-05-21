import formAlert from "../utilities/alert";
import listChanged from "../utilities/listChanged";
import formValidator from "./validator";

export default class TaskManagerForm {
    constructor( form, list ) {
        this.form = form;
        this.list = list;

        this.form.addEventListener( 'submit', event => {
            this.formHandler( event );
        })
    }

    formHandler( event ) {
        event.preventDefault();

        let form = event.target,
            title = form.name,
            descr = form.description,
            date  = form.date,
            estimate  = form.estimate;

        let validator = new formValidator( form );

        if( validator.isValid() == false ) {
            return false;
        }

        let data = new FormData();
        data.append( "action", "task_action" );
        data.append( "nonce", tasks_ajax.nonce );
        data.append( "title", title.value );
        data.append( "descr", descr.value );
        data.append( "date", date.value );
        data.append( "estimate", estimate.value );

        const admin_ajax_url = tasks_ajax.ajax_url;
        fetch( admin_ajax_url, {
            method: "post",
            body: data,
        })
            .then((response) => {
                return response.text();
            })
            .then(( result ) => {
                form.reset();
                listChanged( this.list );
                formAlert( 'Task successfully added' );
            })
            .catch((err) => {
                console.log(err);
            })

    }
}
