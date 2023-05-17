import listChanged from "../utilities/listChanged";
import formAlert from "../utilities/alert";

export default class taskManagerList {
    constructor( list ) {
        this.list = list;

        window.addEventListener( 'DOMContentLoaded', () => {
            listChanged( this.list );
        })

        this.listObserver();
    }


    listObserver() {
        let observer = new MutationObserver( records => {
            for (const record of records) {
                for (const node of record.addedNodes) {
                    this.taskListener( node );
                }
            }
        });

        observer.observe( this.list, {childList: true, subtree: true});
    }

    taskListener( node ) {

        let $this = node,
            postid = $this.dataset.postid,
            header = $this.querySelector( '.card-header' ),
            title  = $this.querySelector( '.card-title' ),
            done  = $this.querySelector( '.btn-done' ),
            remove = $this.querySelector( '.btn-close' );

        if( postid == undefined ) {
            return false;
        }

        title.addEventListener( 'focusout', event => {
            this.taskEdited( postid, title );
        })

        done.addEventListener( 'click', event => {
            event.preventDefault();
            let statement = header.classList.contains( 'text-decoration-line-through' )
            if( statement !== true ) {
                header.classList.add( 'text-decoration-line-through' );
                this.taskStatus( postid, 1 );
            } else {
                header.classList.remove( 'text-decoration-line-through' );
                this.taskStatus( postid, 0 );
            }

        })

        remove.addEventListener( 'click', event => {
            this.deleteTask( postid );
            $this.remove();
        })
    }

    taskEdited( id, title ) {

        let data = new FormData();
        data.append( "action", "task_edit" );
        data.append( "nonce", tasks_ajax.nonce );
        data.append( "id", id );
        data.append( "title", title.textContent.trim() )


        const admin_ajax_url = tasks_ajax.ajax_url;
        fetch( admin_ajax_url, {
            method: "post",
            body: data,
        })
            .then((response) => {
                return response.text();
            })
            .then(( result ) => {
                formAlert( 'Task Edited' );
            })
            .catch((err) => {
                console.log(err);
            })

    }

    deleteTask( id ) {

        let data = new FormData();
        data.append( "action", "task_remove" );
        data.append( "nonce", tasks_ajax.nonce );
        data.append( "id", id );

        const admin_ajax_url = tasks_ajax.ajax_url;
        fetch( admin_ajax_url, {
            method: "post",
            body: data,
        })
            .then((response) => {
                return response.text();
            })
            .then(( result ) => {
                formAlert( 'Task Removed' );
            })
            .catch((err) => {
                console.log(err);
            })

    }

    taskStatus( id, status ) {
        let data = new FormData();
        data.append( "action", "task_status" );
        data.append( "nonce", tasks_ajax.nonce );
        data.append( "id", id );
        data.append( "status", status )

        const admin_ajax_url = tasks_ajax.ajax_url;
        fetch( admin_ajax_url, {
            method: "post",
            body: data,
        })
            .then((response) => {
                return response.text();
            })
            .then(( result ) => {
                if( status == 1 ) {
                    formAlert( 'Task Done');
                } else {
                    formAlert( 'Task blabla');
                }

            })
            .catch((err) => {
                console.log(err);
            })
    }

}