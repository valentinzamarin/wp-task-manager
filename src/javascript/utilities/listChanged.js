const refreshList = ( list ) => {
    let data = new FormData();
    data.append( "action", "task_list" );
    data.append( "nonce", tasks_ajax.nonce );

    const admin_ajax_url = tasks_ajax.ajax_url;
    fetch( admin_ajax_url, {
        method: "post",
        body: data,
    })
        .then((response) => {
            return response.text();
        })
        .then(( result ) => {
            list.innerHTML = result;
        })
        .catch((err) => {
            console.log(err);
        })
}

export default refreshList;