function embedPDF(pdfURL){

    var myPDF = new PDFObject({

        url: pdfURL,
        pdfOpenParams: { pagemode: 'thumbs', scrollbars: '1', toolbar: '1', statusbar: '1', messages: '1', navpanes: '1' }

    }).embed('viewerID');
    // Be sure your document contains an element with the ID 'viewerID'

}

$(document).on('click', '.open_pdf', function () {
    var pdfURL = $(this).attr("url");
    $("#PDFview").fadeIn();
    embedPDF(pdfURL);
});
$(document).on('click', '.close_pdf', function () {
    $("#PDFview").fadeOut();
});