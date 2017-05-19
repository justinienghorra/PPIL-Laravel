function makeToast(str) {
    var toastContent = '<span class="rounded">' + str + '</span>';
    Materialize.toast(toastContent, 5000, 'rounded');
}
