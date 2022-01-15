var currentRow = ''; // currently edited row

$(document).on("keypress", ":input:not(textarea)", function(event) {
  return event.keyCode != 13;
});

$(document).ready(function() {
  $(this).scrollTop(0);
  $( document ).on( 'focus', ':input', function(){
        $( this ).attr( 'autocomplete', 'off' );
    });
});

$(function() {
  if ($('#mainMenu').length && $('#mainMenu').val() != '') {
    $('#' + $('#mainMenu').val()).toggleClass('active');
  }
  if ($('#subMenu').length && $('#subMenu').val() != '') {
    $('#' + $('#subMenu').val()).toggleClass('active');
  }
  $('body').slideDown('slow');
});


function fnsingleFileUpload(which) {
  if (which == 'profilePicture') {
    $('#stamp').val(+new Date);
    upurl = 'beneficiary/singlephotoupload/';
  }

  var formData = new FormData($('#singleFileUpload')[0]);
  $.ajax({
    url: site_url + upurl, //Server script to process data
    type: 'POST',
    xhr: function() { // Custom XMLHttpRequest
      var pXhr = $.ajaxSettings.xhr();
      if (pXhr.upload) { // Check if upload property exists
        // pXhr.upload.addEventListener('progress',progressHandlingFunction, false); // For handling the progress of the upload
      }
      return pXhr;
    },
    //Ajax events
    beforeSend: function() {
      $('#uploadResults').html('<img src ="' + site_url + 'assets/images/loader.gif" /> Uploading..');
      //$('#recordThumpnail').attr('src',site_url+'assets/images/loader.gif');
    },
    success: function(result) {
      //$('.progress-bar').css('width','100%');
      //$('#pageStatus').html('Uploads Completed');
      //show_upload_results(result);

      if (which == 'profilePicture') {
        $('#profilePicture').attr('src', site_url + 'profilephotos/' + result);
        $('#profilePicture').attr('data-value', result);
      } else {
        $('#uploadResults').html(result);
      }
      //$('#recordThumpnail').attr('src',site_url+'uploads/th/'+$('#imageName').val()+'_th.jpg?'+Date());
    },
    //error: errorHandler,
    // Form data
    data: formData,
    //Options to tell jQuery not to process data or worry about content-type.
    cache: false,
    contentType: false,
    processData: false
  });
}

function fileUpload(which, form) {
  if (which == 'DonorPicture' || which == 'inMemoryPicture') {
    $('#txt' + which).val(+new Date);
    upurl = 'tools/singlephotoupload/';
    dir = 'corpus';
  }

  var formData = new FormData($('#' + form)[0]);
  formData.append('dir', dir);
  formData.append('stamp', $('#txt' + which).val());

  $.ajax({
    url: site_url + upurl, //Server script to process data
    type: 'POST',
    xhr: function() { // Custom XMLHttpRequest
      var pXhr = $.ajaxSettings.xhr();
      if (pXhr.upload) { // Check if upload property exists
        // pXhr.upload.addEventListener('progress',progressHandlingFunction, false); // For handling the progress of the upload
      }
      return pXhr;
    },
    //Ajax events
    beforeSend: function() {

    },
    success: function(result) {
      $('#' + which).attr('src', site_url + dir + '/' + result);
      $('#txt' + which).val(result);
    },
    //error: errorHandler,
    // Form data
    data: formData,
    //Options to tell jQuery not to process data or worry about content-type.
    cache: false,
    contentType: false,
    processData: false
  });
}


function fileUploadBinary(which, form) {
  if (which == 'exammarks') {
    $('#txt' + which).val(+new Date);
    upurl = 'tools/singlefileupload/';
    dir = 'exam';
    callback = processExam;
  } else if (which == 'xmlImportAcClose') {
    $('#txt' + which).val(+new Date);
    upurl = 'tools/singlefileupload/';
    dir = 'xml';
    callback = processXML;
  } else if (which == 'prefix') {
    $('#txt' + which).val(+new Date);
    upurl = 'tools/prefixupload/';
    dir = 'exam';
    callback = processPrefix;
  } else if (which == 'Generic') {
    $('#txt' + which).val(+new Date);
    upurl = 'tools/singlefileupload/';
    dir = 'gen';
    callback = processGeneral;
  } else if( which == 'exlBenDeposit'){
    $('#txt' + which).val(+new Date);
    upurl = 'tools/singlefileupload/';
    dir = 'gen';
    callback = processBenDeposit;
  } else if( which == 'exlBenTrial'){
    $('#txt' + which).val(+new Date);
    upurl = 'tools/singlefileupload/';
    dir = 'gen';
    callback = processBenTrial;
  } else if( which == 'exlBenDepositScheme'){
    $('#txt' + which).val(+new Date);
    upurl = 'tools/singlefileupload/';
    dir = 'gen';
    callback = processBenDepositScheme;
  } else if( which == 'exlRazorpay'){
    $('#txt' + which).val(+new Date);
    upurl = 'tools/singlefileupload/';
    dir = 'gen';
    callback = processRazorpay;
  }




  var formData = new FormData($('#' + form)[0]);
  formData.append('dir', dir);
  formData.append('stamp', $('#txt' + which).val());


  $.ajax({
    url: site_url + upurl, //Server script to process data
    type: 'POST',
    xhr: function() { // Custom XMLHttpRequest
      var pXhr = $.ajaxSettings.xhr();
      if (pXhr.upload) { // Check if upload property exists
        // pXhr.upload.addEventListener('progress',progressHandlingFunction, false); // For handling the progress of the upload
      }
      return pXhr;
    },
    //Ajax events
    beforeSend: function() {

    },
    success: function(result) {
      $('#txt' + which).val(result);
      callback();
    },
    //error: errorHandler,
    // Form data
    data: formData,
    //Options to tell jQuery not to process data or worry about content-type.
    cache: false,
    contentType: false,
    processData: false
  });
}

function processBenDeposit(){
  myXHR(site_url + 'tools/readbendepositimport', $('#filterHead').find("select, textarea, input").serialize(), 'boxResult')
}
function processBenDepositScheme(){
  myXHR(site_url + 'tools/readbendepositschemeimport',$('#filterHead').find("select, textarea, input").serialize(), 'boxResult')
}
function processRazorpay(){
  myXHR(site_url + 'tools/readrazorimport',$('#filterHead').find("select, textarea, input").serialize(), 'boxResult')
}

function processBenTrial(){
  myXHR(site_url + 'tools/readbentrialbalanceimport', $('#filterHead').find("select, textarea, input").serialize(), 'boxResult')
}

function processGeneral() {
  alert('Upload Complete');
}

function processExam() {
  myXHR(site_url + 'tools/readexamimport', $('#filterHead').find("select, textarea, input").serialize(), 'boxResult')
}

function processPrefix() {
  myXHR(site_url + 'tools/readprefiximport', $('#filterHead').find("select, textarea, input").serialize(), 'boxResult')
}

function processXML() {
  myXHR(site_url + 'tools/readxmlimport', $('#filterHead').find("select, textarea, input").serialize(), 'boxResult');
}


function examResults() {
  myXHRwithActions(site_url + 'xhr/examresults', $('#filterHead').find("select, textarea, input").serialize(), 'boxResult', sortExamtable)
}

function innterviewCandidates() {
  myXHRwithActions(site_url + 'xhr/innterviewcandidates', $('#filterHead').find("select, textarea, input").serialize(), 'boxResult', sortExamtable)
}

function studentCandidates() {
  myXHRwithActions(site_url + 'xhr/students', $('#filterHead').find("select, textarea, input").serialize(), 'boxResult', sortExamtable);
}

function sortExamtable() {
  $('#tableExam').DataTable({
    'paging': false,
    'lengthChange': false,
    'searching': true,
    'ordering': true,
    'info': true,
    'autoWidth': false
  });
}

function myXHR(url, praram, id) {
  $.ajax({
    url: url,
    type: 'post',
    data: praram,
    cache: false,
    beforeSend: function() {
      if ($('#' + id).length) {
        $('#' + id).html('<span style="font-size:100px;opacity:0.1;text-align:center;display:block" class="fa fa-cog fa-spin"></span>');
      }
    },
  }).done(function(result) {
    if ($('#' + id).length) {
      $('#' + id).html(result);
    }
  });
}


function myXHRwithActions(url, praram, id, action) {
  var start_time = new Date().getTime(); // get ajax start time
  $.ajax({
    url: url,
    type: 'post',
    data: praram,
    cache: false,
    beforeSend: function() {
      if ($('#' + id).length) {
        $('#' + id).html('<span style="font-size:100px;opacity:0.1;text-align:center;display:block" class="fa fa-cog fa-spin"></span>');
      }
    },
  }).done(function(result) {
    if ($('#' + id).length) {
      $('#' + id).html(result);
    }
    action();
  });
}

function geteduforum(val, id) {
  $.post(site_url + "xhr/getedufrm", {
    forane: val.split('|')[0]
  }).done(function(data) {
    $('#' + id).html(data);
    if ($('#setEduFrm').length && !$('#scapeModal').hasClass('in')) { // modal not open & hidden field exist
      $('#selEduFrm').val($('#setEduFrm').val()).change();
    } else {
      $('#' + id).change();
    }
  });
}

function searchSuggest(val, id) {
  var pos = $('#' + id).offset();
  $('#searchSuggest').css({
    'top': pos.top + 30,
    'left': pos.left
  });
  if (val.length > 1) {
    $('#searchSuggest').css('display', '');
    myXHR(site_url + 'xhr/searchsuggest', 'q=' + val + '&opt=', 'searchSuggest');
  } else {
    $('#searchSuggest').html('');
    $('#searchSuggest').css('display', 'none');
  }
}

function searchAndAdd(val, id) {
  var pos = $('#' + id).offset();
  $('#searchSuggest').css({
    'top': pos.top + 30,
    'left': pos.left
  });
  if (val.length > 1) {
    $('#searchSuggest').css('display', '');
    myXHR(site_url + 'xhr/searchsuggest', 'q=' + val + '&opt=add', 'searchSuggest');
  } else {
    $('#searchSuggest').html('');
    $('#searchSuggest').css('display', 'none');
  }
}

function searchAndCheckEleigibile(val, id) {
  var pos = $('#' + id).offset();
  $('#searchSuggest').css({
    'top': pos.top + 30,
    'left': pos.left
  });
  if (val.length > 1) {
    $('#searchSuggest').css('display', '');
    myXHR(site_url + 'xhr/searchsuggesteligiblity', 'q=' + val + '&opt=add', 'searchSuggest');
  } else {
    $('#searchSuggest').html('');
    $('#searchSuggest').css('display', 'none');
  }
}

function searchAndAck(val, id) {
  var pos = $('#' + id).offset();
  $('#searchSuggest').css({
    'top': pos.top + 30,
    'left': pos.left
  });
  if (val.length > 1) {
    $('#searchSuggest').css('display', '');
    myXHR(site_url + 'xhr/searchsuggestcert', 'q=' + val + '&opt=add', 'searchSuggest');
  } else {
    $('#searchSuggest').html('');
    $('#searchSuggest').css('display', 'none');
  }
}

function searchAndEdit(val, id) {
  var pos = $('#' + id).offset();
  $('#searchSuggest').css({
    'top': pos.top + 30,
    'left': pos.left
  });


  if (val.length > 1) {
    $('#searchSuggest').css('display', '');
    myXHR(site_url + 'xhr/searchsuggestappl', 'q=' + val + '&opt=add', 'searchSuggest');
  } else {
    $('#searchSuggest').html('');
    $('#searchSuggest').css('display', 'none');
  }

}

function searchAndEditWithFilter(val, batch, id) {
  var pos = $('#' + id).offset();
  $('#searchSuggest').css({
    'top': pos.top + 30,
    'left': pos.left
  });


  if (val.length > 1) {
    $('#searchSuggest').css('display', '');
    myXHR(site_url + 'xhr/searchsuggestfilter', 'q=' + val + '&batch='+batch+'&opt=add', 'searchSuggest');
  } else {
    $('#searchSuggest').html('');
    $('#searchSuggest').css('display', 'none');
  }

}

function advancedSearch(val) {

  if (val == 'beneficiary') {
    myXHR(site_url + 'xhr/advbensearchsuggest', $('#frmBenAdvanceSearch').serialize() + '&SelForaneT=' + $('#SelForaneS').val() + '|' + $('#SelForaneS :selected').text(), 'searchResults');
  }
  if (val == 'closing') {
    myXHR(site_url + 'xhr/advbensearchsuggest', $('#frmBenAdvanceSearch').serialize() + '&SelForaneT=' + $('#SelForaneS').val() + '|' + $('#SelForaneS :selected').text(), 'searchResultsDel');
  }
  if (val == 'beneficiary_passbook') {
    myXHR(site_url + 'xhr/advbensearchsuggestpassbook', $('#frmBenAdvanceSearch').serialize() + '&SelForaneT=' + $('#SelForaneS').val() + '|' + $('#SelForaneS :selected').text(), 'searchResults');
  }
  if (val == 'corpusfund') {
    myXHR(site_url + 'xhr/advcorpsearchsuggest', $('#frmCorpAdvanceSearch').serialize(), 'searchResults');
  }
  if (val == 'beneficiary_passbook_laser') {
    myXHR(site_url + 'xhr/advbensearchsuggestpassbooklaser', $('#frmBenAdvanceSearch').serialize() + '&SelForaneT=' + $('#SelForaneS').val() + '|' + $('#SelForaneS :selected').text(), 'passbookPrintQueue');
  }

  return false;
}

function viewBeneficiary(val) {
  location.href = site_url + 'beneficiary/view/' + val;
}

function viewBeneficiaryPayments(val){
  $('#searchSuggest').html('');
  $('#searchSuggest').css('display','none');
  $.post(site_url + 'scholarship/eligibilitycalc', 'old_id=' + val +'&stamp=' + Date()).done(function(data) {
    $('#resultPlane').html(data);
  });
}

function validateBen() {
  var beneficiaryData = $('#frmAddBeneficiary').serialize() + '&' + 'txtBenPhoto=' + $('#profilePicture').attr('data-value');
  //myXHR(site_url+'beneficiary/add_',beneficiaryData,'testres');

  $.post(site_url + 'beneficiary/add_', beneficiaryData).done(function(data) {


    // if (confirm("Beneficiary " + data + " Added Successfully! \n\n Do you want to print PassBook?")) {
    //     window.open(site_url + "beneficiary/makeprint/" + data, "_blank");
    //     $('#frmAddBeneficiary')[0].reset();
    // } else {
    //     $('#frmAddBeneficiary')[0].reset();
    // }
    alert("Beneficiary " + data + " Added Successfully!");
    if($('#newNidhi').length){
      $.post(site_url + "beneficiary/nidhientryack", $('#frmAddBeneficiary').serialize()+'&old_id='+data).done(function(data) {
        alert(data);
        $('#frmAddBeneficiary')[0].reset();
      });
    }


  });
  return false;
}

function updateBen() {
  var beneficiaryData = $('#frmAddBeneficiary').serialize() + '&' + 'txtBenPhoto=' + $('#profilePicture').attr('data-value');
  /*
  myXHR(site_url+'beneficiary/update_',beneficiaryData,'testres');
  notice(message,type)
  */
  //beneficiary/view/'+$('#nidhi_member').val();

  $.post(site_url + "beneficiary/update_", beneficiaryData).done(function(data) {
    notice('Beneficiary updated Successfully ', 'info');
    if($('#newNidhi').length){
      $.post(site_url + "beneficiary/nidhientryack", $('#frmAddBeneficiary').serialize()).done(function(data) {
        alert(data);
        location.href = site_url + 'beneficiary/view/' + $('#txtId').val();
      });
    }else{
      setTimeout(function() {
        location.href = site_url + 'beneficiary/view/' + $('#txtId').val();
      }, 2000);
    }
  });
  return false;
}

function showModal(val,opt='') {
  var url2Load, prarams, title = '';
  var showFooter = false;
  $('#scapeModalFooter').css('display', 'none');

  if ( val == 'reviewScholarship'){
    url2Load = 'scholarship/loadscholarshipforreview';
    title = 'Review Scholarship';
    prarams = 'id='+opt;
  }

  if (val == 'qualification') {
    url2Load = 'headless/qualification_search';
    title = 'Search Qualification';
  }

  if (val == 'orphanCertificates') {
    url2Load = 'xhr/orphancertificates';
    title = 'Orphan Share Certificates';
  }


  if (val == 'advBenSearch') {
    url2Load = 'headless/beneficiary_search';
    title = 'Advance Beneficiary Search';
  }
  if (val == 'passbookBatch') {
    url2Load = 'headless/passbook_batch_search';
    title = 'PassBook Batch Printing';
  }
  if (val == 'passbookBatchLaser') {
    url2Load = 'headless/passbook_batch_search_laser';
    title = 'PassBook Batch Printing';
  }
  if (val == 'advCorpSearch') {
    url2Load = 'headless/corp_search';
    title = 'Advance Corpus Fund Search';
  }
  if (val == 'corpAddFund') {
    url2Load = 'headless/add_fund';
    title = 'Add Fund';
    prarams = 'doner=' + $('#txtDId').val();
  }

  if (val == 'applExport') {
    url2Load = 'headless/gettable/application';
    title = 'Select columns to export';
    showFooter = true;
    $('#scapeModalFooter').html('<button onclick="exportAppl()" class="btn btn-primary" type="button">Export to Excel</button>');

  }
  if (val == 'benExport') {
    url2Load = 'headless/gettable/member';
    title = 'Select columns to export';
    showFooter = true;
    $('#scapeModalFooter').html('<button onclick="exportBen()" class="btn btn-primary" type="button">Export to Excel</button>');

  }

  if (val == 'createNidhiMember') {
    url2Load = 'share/createmember';
    title = 'Create New Nidhi Member';
    showFooter = true;
    $('#scapeModalFooter').html('<span onclick="$(' + "'#frmCreateNidhiMember'" + ').submit();" class="btn btn-primary center-block" >Create Member</span>');
  }

  if (val == 'createShare') {
    if ($('#txtMembershipID').val() == '' || $('#txtMembershipID').val() == 0) {
      alert('This user is not a Nidhi Member');
      return;
    }
    url2Load = 'share/createshare';
    title = 'Issue New Share';
    showFooter = true;
    $('#scapeModalFooter').html('<span onclick="$(' + "'#frmCreateShare'" + ').submit();" class="btn btn-primary center-block" >Issue Share</span>');
  }
  if (val == 'orphanShares') {
    url2Load = 'tools/getmissingshares';
    title = 'Missing / Orphan Shares';
    showFooter = false;
  }
  if (val == 'viewShares') {
    if ($('#txtMembershipID').val() == '' || $('#txtMembershipID').val() == 0) {
      alert('This user is not a Nidhi Member');
      return;
    }
    url2Load = 'share/getsharelist';
    title = '';
    prarams = 'holderID=' + $('#shareBenId').val();
    showFooter = false;
  }

  if (showFooter) {
    $('#scapeModalFooter').css('display', '');
  }

  //load modal
  $('#scapeModalTitle').html(title);
  $('#scapeModal').modal('show');

  myXHR(site_url + url2Load, prarams, 'scapeModalBody');
}

function showCorpDonations(id) {

  $('#scapeModalTitle').html('Donation History');
  $('#scapeModal').modal('show');
  $('#scapeModalFooter').css('display', 'none');
  myXHR(site_url + '/headless/corpdonationhistory/' + id, '', 'scapeModalBody');
}

function searchQual(val) {
  myXHR(site_url + 'xhr/qualificationsuggest', 'q=' + val, 'qualSearchResults');
}

function addQualification(val) {
  $('#txtQualification').tagsinput('add', val);
  $('#scapeModal').modal('hide');
}

function createCourse() {
  myXHRwithActions(site_url + 'course/create_', $('#frmCreateCourse').serialize(), 'boxResult', clearform('course'));
  return false;
}

function createBatch() {
  myXHRwithActions(site_url + 'batch/create_', $('#frmCreateBatch').serialize() + '&txtCourseName=' + $('#SelCourseId :selected').text(), 'boxResult', clearform('batch'));
  return false;
}

function clearform(val) {
  if (val == 'course') {
    $('form')[0].reset();
    notice('Course Created', 'success');
  }
  if (val == 'batch') {
    $('form')[0].reset();
    notice('Batch Created', 'success');
  }
}

function loadWithPage(event) {
  var url2Load, prarams, element = '';
  if (event == 'courselist') {
    url2Load = 'xhr/courselist';
    element = 'boxResult';
  }
  if (event == 'batchlist') {
    url2Load = 'xhr/batchlist';
    element = 'boxResult';
  }
  if (event == 'courselistscholar') {
    url2Load = 'xhr/courselistscholar';
    element = 'boxResult';
  }
  if (event == 'accounts') {
    url2Load = 'accounts/minitransaction';
    element = 'addFundResults';
  }

  myXHR(site_url + url2Load, prarams, element);

}

function notice(message, type) {

  $.notify({
    // options
    icon: 'glyphicon glyphicon glyphicon-ok',
    message: ' ' + message,
  }, {
    // settings
    element: 'body',
    position: null,
    type: type,
    allow_dismiss: true,
    newest_on_top: false,
    showProgressbar: false,
    placement: {
      from: "top",
      align: "center"
    },
    offset: 20,
    spacing: 10,
    z_index: 1031,
    delay: 5000,
    timer: 1000,
    url_target: '_blank',
    mouse_over: null,
    animate: {
      enter: 'animated fadeInDown',
      exit: 'animated fadeOutUp'
    },
    onShow: null,
    onShown: null,
    onClose: null,
    onClosed: null,
    icon_type: 'class',
    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
    '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
    '<span data-notify="icon"></span> ' +
    '<span data-notify="message">{2}</span>' +
    '</div>'
  });

}

function editRow(val) {
  var temp;
  if (currentRow == '') {
    currentRow = val;
    $('#editR' + val).css('display', 'none');
    $('#saveR' + val).css('display', '');
  } else {
    alert('Only one entry can be eddited at a time');
    return;
  }

  $('#row' + val + ' td').each(function() {
    if ($(this).attr('data-exclude') != 'exclude') {
      temp = $(this).html();
      $(this).html('');
      $(this).append('<input class="form-control" type="text" value="' + temp + '" name="' + $(this).attr('data-fieldname') + '">');
    }
  });
}

function saveRow(val, frm) {
  var postUrl = '';
  $('#row' + val).find("select, textarea, input").serialize();
  if (frm == 'course') {
    postUrl = 'course/update_';
  }
  if (frm == 'batch') {
    postUrl = 'batch/update_';
  }
  if (frm == 'scholarship') {
    postUrl = 'scholarship/update_course';
  }
  myXHR(site_url + postUrl, $('#row' + val).find("select, textarea, input").serialize() + '&id=' + currentRow, 'boxResult');
  currentRow = '';
}

function addRowCourse(){
  $.post(site_url + 'scholarship/addnewcourse',$('#newCourseEntry input, select').serialize()).done(function(data) {
    loadWithPage('courselistscholar');
    $('#newCourseEntry input, select').val('');
  });
}

function deleteRow(val, frm) {
  var isDelete = confirm('Are you sure to delete '+$('#row'+val+' td[data-fieldname="course"]').html()+' course?');
  if(!isDelete){
    return false;
  }
  var postUrl = '';
  if (from = 'deleteRow') {
    postUrl = 'batch/delete_';
  }
  if (from = 'scholarship') {
    postUrl = 'scholarship/delete_course';
  }

  myXHR(site_url + postUrl, 'id=' + val, 'boxResult');
}

function exportEX(val) {
  location.href = site_url + 'export/' + val;
}

function addBenToForm(val) {
  $('#searchSuggest').html('');
  $('#searchSuggest').css('display', 'none');
  if ($('#frmNewApplication').length) {
    $('#frmNewApplication')[0].reset();
  }
  $.post(site_url + "xhr/getbeneficiary", {
    id: val
  }).done(function(data) {

    obj = JSON.parse(data);

    // Set Fields
    $('#txtNesId').val(obj[0].old_id);
    $('#txtStudName').val(obj[0].name);
    $('#selGender').val(obj[0].gender);
    $('#txtSchool').val(obj[0].school);
    $('#txtMedium').val(obj[0].medium);
    $('#txtSyllabus').val(obj[0].syllabus);
    $('#txtGuardian').val(obj[0].guardian_name);
    $('#txtEduFrm').val(obj[0].education_forum);
    // removed phone adding to form by the request of Raphel sir on 17/12/2018
    // $('#txtPhone').val(obj[0].guardian_phone);
    // $('#txtPhoneSec').val(obj[0].nominee_phone);
    $('#txtBCCNum').val(obj[0].bcc_number);
    $('#txtBCCName').val(obj[0].bcc_name);
    if(obj[0].is_nidhi == '1'){
      $('#isNidhi').html(' <span class="label bg-green">Nidhi</label>');
    }else{
      $('#isNidhi').html(' <span class="label bg-red">Scheme</label>');
    }

    if ($('#txtAccountDate').length) {
      $('#txtAccountDate').val(obj[0].account_date);
    }

    if (obj[0].photoid != null) {
      $('#profilePicture').attr('src', site_url + 'profilephotos/' + obj[0].photoid);
    } else {

      $('#profilePicture').attr('src', site_url + '/assets/images/pofilepic.png');
    }

    if ($('#selRegular').length) {
      getPreviousScholarshipData(obj[0].old_id);
      var d = new Date();
      var n = d.getFullYear();
      var yearss = n - parseInt($('#txtAccountDate').val().split('-')[0]);
      if (yearss > 9) {
        $('#selMembershipPeriod').val(3);
      } else if (yearss > 6) {
        $('#selMembershipPeriod').val(2);
      } else if (yearss > 4) {
        $('#selMembershipPeriod').val(1);
      }
    }

    if ($('#txtPayee').length) {
      $('#txtPayee').val(obj[0].name);
    }

    if ($('#txtSearch').length) {
      $('#txtSearch').val('');
    }

    getYearlyTransaction(obj[0].old_id);
  });
}

function getPreviousScholarshipData(val) {
  myXHRwithActions(site_url + 'xhr/getscholarshipdetails', 'id=' + val, 'boxResult', setScholarshipStatus);
}

function setScholarshipStatus() {
  //iftableScholarships
  if ($('#tableScholarships').length) {
    $('#selStatus').val('Renewal');
  }
  if ($('#selGender').length) {
    $('#selGender').val($('#storedGender').val());
  }

  var d = new Date();
  var n = d.getFullYear();

  if (parseInt($('#tableScholarships td:last').html()) == n) {
    var appedit = confirm('Scholarship Entry for this year ' + n + ' already exist for this candidate. Do you want to edit the application?');
    if (appedit) {
      location.href = site_url + 'scholarship/editscholarship/' + $('#txtNesId').val();
    } else {
      location.href = site_url + 'scholarship/newapplication/'
    }
  }
}

function saveApplication() {
  if ($('#txtBatch').val() == '') {
    alert('Please select the batch');
    return false;
  }
  // Get Start Year
  var yer = $('#txtBatch :selected').text().trim().split(' ');
  yer = yer[yer.length - 1].split('-');
  yer = yer[0].substring(2, 4);

  var batch = $('#txtBatch').val().split('|');
  abbr = batch[1];

  $.post(site_url + "batch/saveapplication_", $('#frmNewApplication').serialize() + '&txtBatch=' + batch[0] + '&year=' + yer + '&abbr=' + abbr).done(function(data) {
    if (data != 'error') {
      notice('Application Saved Successfully ', 'info');
      alert('Application ID : ' + data);
      $('#frmNewApplication')[0].reset();
      $('#txtSearch').val('');
    } else {
      notice('Error Saving Date Please Check', 'error');
    }
  });

  return false;
}

function saveScholoarshipApplication() {
  $(this).scrollTop(0);
  if ($('#txtNesId').val() == '') {
    alert('Please select the Beneficiary');
    return false;
  }

  $.post(site_url + "scholarship/saveapplication_", $('#frmNewApplication').serialize() + '&course=' + $('#selCourse option:selected').text()).done(function(data) {
    if (data != 'error') {
      notice('Application Saved Successfully ', 'info');
      alert('Application ID : ' + data);
      $('#frmNewApplication')[0].reset();
      $('#txtSearch').val('');
    } else {
      notice('Error Saving Date Please Check', 'error');
    }
  });
  return false;
}

function updateScholoarshipApplication() {
  $(this).scrollTop(0);
  if ($('#txtNesId').val() == '') {
    alert('Please select the Beneficiary');
    return false;
  }

  $.post(site_url + "scholarship/updateapplication_", $('#frmNewApplication').serialize() + '&course=' + $('#selCourse option:selected').text()).done(function(data) {
    if (data != 'error') {
      notice('Application Saved Successfully ', 'info');
      alert(data);
      location.href = site_url + 'scholarship/newapplication/'
    } else {
      notice('Error Saving Date Please Check', 'error');
    }
  });
  return false;
}


function porcessScholarship() {
  if ($('#txtScholarshipAmount').val() == '') {
    alert('Please Enter Net Availabe Amount');
    return false;
  }
  notice('Processing please wait', 'info');
  $.post(site_url + "scholarship/porcessscholarship", $('#frmNewApplication').serialize()).done(function(data) {
    if (data != 'error') {
      $('#boxResult').html(data);
      //alert('Application ID : '+data);
    } else {
      notice('Error Saving Date Please Check', 'error');
    }
  });
  return false;
}

function cal12Total() {
  var total = (parseInt($('#txtA1').val() || 0) * 91) +
  (parseInt($('#txtA').val() || 0) * 81) +
  (parseInt($('#txtB1').val() || 0) * 70) +
  (parseInt($('#txtB').val() || 0) * 60) +
  (parseInt($('#txtC1').val() || 0) * 50) +
  (parseInt($('#txtC').val() || 0) * 40) +
  (parseInt($('#txtD1').val() || 0) * 30) +
  (parseInt($('#txtD').val() || 0) * 20);
  var subjects = (parseInt($('#txtA1').val()) || 0) +
  (parseInt($('#txtA').val()) || 0) +
  (parseInt($('#txtB1').val()) || 0) +
  (parseInt($('#txtB').val()) || 0) +
  (parseInt($('#txtC1').val()) || 0) +
  (parseInt($('#txtC').val()) || 0) +
  (parseInt($('#txtD1').val()) || 0) +
  (parseInt($('#txtD').val()) || 0);
  var points = 0;

  $('#txt12total').val(total / subjects);

  if ($('#txt12total').val() > 90) {
    points += 3;
  } else if ($('#txt12total').val() > 80) {
    points += 2;
  } else if ($('#txt12total').val() > 50) {
    points += 1;
  }

  points += parseInt($('#selCourse').val());
  points += parseInt($('#selPerfomance').val());
  points += parseInt($('#selRegular').val());
  points += parseInt($('#txtSpcialPoints').val());
  points += parseInt($('#selMembershipPeriod').val());
  points += parseInt($('#selGender').val());
  $('#totalPoints').val(points);
}

function saveShareApp() {
  $.post(site_url + "receipt/saveapplication_", $('#frmNewApplication').serialize()).done(function(data) {
    if (data != 'error') {
      notice('Application Saved Successfully ', 'info');
      alert('Application ID : ' + data);
      $('#frmNewApplication')[0].reset();
      $('#txtSearch').val('');
    } else {
      notice('Error Saving Date Please Check', 'error');
    }
  });
  return false;
}

function updateApplication() {
  if ($('#txtBatch').val() == '') {
    alert('Please select the batch');
    return false;
  }
  $.post(site_url + "batch/updateapplication_", $('#frmNewApplication').serialize()).done(function(data) {
    if (data != 'error') {
      notice('Application Updated Successfully ', 'info');
      alert('Application ID : ' + data + ' Updated');
      $('#frmNewApplication')[0].reset();
      $('#txtSearch').val('');
    } else {
      notice('Error Saving Date Please Check', 'error');
    }
  });
  return false;
}
function studentEnroll() {
  if ($('#txtBatch').val() == '') {
    alert('Please select the batch');
    return false;
  }
  $.post(site_url + "batch/studentenroll_", $('#frmNewApplication').serialize()).done(function(data) {
    if (data != 'error') {
      notice('Student Enrolled Successfully ', 'info');
      alert(data + " enrolled as student.");
      $('#frmNewApplication')[0].reset();
      $('#txtSearch').val('');
    } else {
      notice('Error Saving Date Please Check', 'error');
    }
  });
  return false;
}
function getCandidatesFilter() {
  if($('#txtStatus').val() == 'Student' ){
    $('#selYear').removeAttr('disabled');
  }else{
    $('#selYear').val('');
    $('#selYear').attr('disabled','disabled');
  }
  myXHRwithActions(site_url + 'xhr/candidatesfilter', $('#filterHead :input').serialize(), 'boxResult', sortExamtable);
  $('#boxResult').css('font-size', '11px');
}

function getScholarshipFilter() {
  myXHRwithActions(site_url + 'xhr/scholarshipfilter', $('#filterHead :input').serialize(), 'boxResult', sortExamtable);
  $('#boxResult').css('font-size', '11px');
}

function getScholarshipFilterCourseWise() {
  myXHRwithActions(site_url + 'xhr/scholarshipfiltercoursewise', $('#filterHead :input').serialize(), 'boxResult', sortExamtable);
  $('#boxResult').css('font-size', '11px');
}

function getScholarshipFilterForumWise() {
  myXHRwithActions(site_url + 'xhr/scholarshipfilterforumwise', $('#filterHead :input').serialize(), 'boxResult', sortExamtable);
  $('#boxResult').css('font-size', '11px');
}

function getCampFilter() {
  myXHR(site_url + 'xhr/campfilter', $('#filterHead :input').serialize(), 'boxResult');
  $('#boxResult').css('font-size', '11px');
}

function getBeneficaryFilter() {
  myXHR(site_url + 'xhr/beneficaryfilter', $('#filterHead :input').serialize(), 'boxResult');
  $('#boxResult').css('font-size', '11px');
}

function getShareMemberFilter() {
  myXHR(site_url + 'xhr/sharememberfilter', $('#filterHead :input').serialize(), 'boxResult');
  $('#boxResult').css('font-size', '11px');
}

function getForumwiseAggregate() {
  myXHR(site_url + 'xhr/forumwiseaggregate', $('#filterHead :input').serialize(), 'boxResult');
  $('#boxResult').css('font-size', '18px');
}

function exportAppl() {
  var columns = [];
  $.each($("#scapeModalBody input:checked"), function() {
    columns.push($(this).val());
  });
  /*myXHR(site_url+'export/applicationlist',$('#filterHead :input').serialize()+'&col='+columns,'exportFrame');*/
  $.post(site_url + 'export/applicationlist', $('#filterHead :input').serialize() + '&col=' + columns).done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function exportBen() {
  var columns = [];
  $.each($("#scapeModalBody input:checked"), function() {
    columns.push($(this).val());
  });
  /*myXHR(site_url+'export/applicationlist',$('#filterHead :input').serialize()+'&col='+columns,'exportFrame');*/
  $.post(site_url + 'export/beneficiarylist', $('#filterHead :input').serialize() + '&col=' + columns).done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function exportCorpFund() {
  $.post(site_url + 'export/corplist').done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function addApplToForm(val) {
  $('#searchSuggest').html('');
  $('#searchSuggest').css('display', 'none');
  $.post(site_url + "xhr/getapplicant", {
    id: val
  }).done(function(data) {

    obj = JSON.parse(data);

    // Set Fields
    $('#appID span').html(obj[0].id);
    $('#spCourseId').html(obj[0].generated_id);
    $('#txtAppId').val(obj[0].id);
    $('#txtNesId').val(obj[0].nes_id);
    $('#txtStudName').val(obj[0].student_name);
    $('#selGender').val(obj[0].gender);
    $('#txtSchool').val(obj[0].school);
    $('#txtMedium').val(obj[0].medium);
    $('#txtSyllabus').val(obj[0].syllabus);
    $('#txtGuardian').val(obj[0].guardian);
    $('#txtEduFrm').val(obj[0].education_forum);
    $('#txtPhone').val(obj[0].phone);
    $('#txtPhoneSec').val(obj[0].phone_secondry);
    $('#txtBCCNum').val(obj[0].bcc_number);
    $('#txtBCCName').val(obj[0].bcc_name);
    $('#txtReceipt').val(obj[0].receipt);

    /*	 if(obj[0].photoid != null){
    $('#profilePicture').attr('src',site_url+'profilephotos/'+obj[0].photoid);
  }else{

  $('#profilePicture').attr('src',site_url+'/assets/images/pofilepic.png');
}*/

});
}

function viewProfile(val) {
  if (val != '') {
    window.open(site_url + "beneficiary/view/" + val, "_blank");
  }
}

function viewDonorProfile(val) {
  if (val != '') {
    window.open(site_url + "corpusfund/view/" + val, "_blank");
  }
}

function exportForumwiseAggr() {
  $.post(site_url + 'export/forumwiseaggregate', $('#filterHead :input').serialize()).done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function exportCertAck() {
  $.post(site_url + 'export/certacklist', $('#filterHead :input').serialize()).done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function exportExamResult() {
  $.post(site_url + 'export/examresults', $('#filterHead').find("select, textarea, input").serialize()).done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function exportInterviewCandidates() {
  $.post(site_url + 'export/innterviewcandidates', $('#filterHead').find("select, textarea, input").serialize()).done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function exportScholarshipAlloties() {
  $.post(site_url + 'export/scholarshipalloties', $('#filterHead').find("select, textarea, input").serialize()).done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function exportScholarshipForumwise() {
  $.post(site_url + 'export/scholarshipforumwise', $('#filterHead').find("select, textarea, input").serialize()).done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function exportScholarshipCoursewise() {
  $.post(site_url + 'export/scholarshipcoursewise', $('#filterHead').find("select, textarea, input").serialize()).done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function exportScholarshipIndividualHistory(){
  $.post(site_url + 'export/scholarshipindividualhistory').done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function exportStudentCandidates() {
  $.post(site_url + 'export/studentscandidates', $('#filterHead').find("select, textarea, input").serialize()).done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function accountsTallyExport() {
  $('#multiexport').hide();
    $('#btnTallyexport').html('<img style="width:20px" src ="' + site_url + 'assets/images/loading.gif" /> Uploading..');
  $.post(site_url + 'export/accountstally', $('#filterHead :input').serialize()).done(function(data) {
    $('#multiexport').show();
    $('#btnTallyexport').html('Tally Export');
  });
}

function setExport(which){
  $('#exportFrame').attr('src', site_url + 'export/' + which + '.xlsx');
}

function promotetointerview() {
  $.post(site_url + 'batch/promotetointerview', $('#filterHead').find("select, textarea, input").serialize()).done(function(data) {
    $('#boxResult').html(data);
  });
}

function promoteToStudent() {
  $.post(site_url + 'batch/promotetostudent', $('#filterHead').find("select, textarea, input").serialize()).done(function(data) {
    $('#boxResult').html(data);
  });
}

function validateDon() {
  var donData = $('#frmAddDonor').serialize();
  //myXHR(site_url+'beneficiary/add_',beneficiaryData,'testres');

  $.post(site_url + 'corpusfund/add_', donData).done(function(data) {
    alert("Donor Added Successfully! \n\n Door ID : " + data);
    location.reload();
  });
  return false;
}

function updateDon() {
  var donData = $('#frmAddDonor').serialize();
  //myXHR(site_url+'beneficiary/add_',beneficiaryData,'testres');

  $.post(site_url + 'corpusfund/update_', donData).done(function(data) {
    alert("Donor Updated Successfully! \n\n Door ID : " + data);
    location.reload();
  });
  return false;
}

function calulateTotalMarks(id) {
  $('#txtTot' + id).val((((parseFloat($('#sp' + id).html()) / 5) * 3) + ((parseFloat($('#txtInt' + id).val()) / 5) * 2)).toFixed(2));
}

function updateInterviewMarks() {
  $.post(site_url + 'batch/intereviewmarks', $('#boxResult input').serialize()).done(function(data) {
    alert(data);
    //location.reload();
  });
  return false;

}

function editIntervewmarks() {
  $('input[id^="txtInt"]').removeAttr('readonly');
  $('#editMarks').html('Edit Mode');
}

function getBenStatus(id) {
  $('#btnBenStatus').webuiPopover({
    type: 'async',
    url: site_url + 'headless/getbenstatus/' + id
  });
}

function shareCal() {

  /* share search logic

  var tShare = $('#txtShareId').val().split(',');
  var shares = [],i,tmp;

  tShare.forEach(function(item, index){

  if(item.indexOf('-') > 0){
  tmp = item.split('-');
  for(i = parseInt(tmp[0]); i <= parseInt(tmp[1]); i++ ){
  shares.push(i);
}
}else if(parseInt(item)>0){
shares.push(parseInt(item));
}
});
shares = $.unique(shares.sort());
$('#txtShareCount').val(shares.length);*/

if ($('#txtShareId').val() == 0) {
  $('#txtShareCount').val(0);
  return;
}



$.post(site_url + 'tools/sharecal', {
  shareID: $('#txtShareId').val(),
  userID: $('#txtId').val()
}).done(function(data) {
  if (isNaN(data)) {
    $('#txtShareCount').val('');
    $('#shareError').html(data);
    $('#shareError').css('color', 'red');
    $('#shareError').css('overflow', 'scroll');
  } else {
    $('#txtShareCount').val(data);
    $('#shareError').html('Shares Available');
    $('#shareError').css('color', 'green');
    $('#shareError').css('overflow', 'hidden');
  }

});

}

function checkNidhiMembership() {
  $('#selIsNidhi').val(1);
  if ($('#selIsNidhi').val() != 1) {
    $('#txtMembershipID').val('');
    $('#txtMembershipID').attr('placeholder', 'Click to check Membership status');
    return;
  }

  if ($('#txtGuardian').val() == '') {
    alert('Please Enter Guardain Name before Nidhi Enrolment');
    $('#selIsNidhi').val(0);
    return;
  }

  if ($('#txtGuardianAadhaar').val().length == 12 && !isNaN($('#txtGuardianAadhaar').val())) {
    $('#txtMembershipID').attr('placeholder', 'Checking Membership..')
    $.post(site_url + 'share/checkmember', {
      aadhaar: $('#txtGuardianAadhaar').val()
    }).done(function(data) {
      if (isNaN(data)) {
        showModal('createNidhiMember');
      } else {
        $('#txtMembershipID').val(data);
      }
    });

  } else {
    alert('Please enter 12 digit Guardain Aadhaar Number correctly before enroling for Nidhi');
    $('#selIsNidhi').val(0);
  }
}

function createNidhiMember() {
  $.post(site_url + 'share/createmember_', {
    aadhaar: $('#txtMemberAaDhaar').val(),
    memberName: $('#txtMemberName').val()
  }).done(function(data) {
    if (isNaN(data)) {
      showModal('createNidhiMember');
      $('#selIsNidhi').val(0);
    } else {
      $('#txtMembershipID').val(data);
      $('#scapeModal').modal('hide');
      $('#selIsNidhi').val(1);
      $('#nidhiEnrollbtn').html('<div class="btn btn-xs btn-success">Nidhi Enroled</div>');
    }
  });
  return false;
}

function createNewShare() {

  if ($('#txtShareId').val() == '' || $('#txtShareCount').val() == '') {
    alert('Share ID and Share Count cannot be empty');
    return false;
  }
  if ($('#txtShareCount').val() == 0) {
    alert('Minimum Share count is 1');
    return false;
  }
  $.post(site_url + 'share/createshare_', {
    member_id: $('#txtMembershipID').val(),
    holder_id: $('#shareBenId').val(),
    share_id: $('#txtShareId').val(),
    share_count: $('#txtShareCount').val(),
    txtCertOverride: $('#txtCertOverride').val()
  }).done(function(data) {
    if (isNaN(data)) {
      alert(data);
      $('#scapeModalFooter').html('');
      $('#scapeModal').modal('hide');
    } else {
      $('#scapeModalBody').html('<h2>Share issued with Certificate No : ' + data + '</h2>');
      $('#scapeModalFooter').html('');
      //$('#scapeModal').modal('hide');
    }
    if ($('#shareBlk' + $('#shareBenId').val()).length) {
      $('#shareBlk' + $('#shareBenId').val()).remove();
    }
  });
  return false;
}

function showOrphanShares() {
  myXHR(site_url + 'tools/getmissingshares', '', 'orpahanShares');
}

function exportShareApplList() {
  $.post(site_url + 'export/shareapplicationlist', {
    from: $('#txtFrom').val(),
    to: $('#txtTo').val()
  }).done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function exportMemberList() {
  notice('Loading please wait...', 'info');
  $.post(site_url + 'export/sharememberlsit', $('#filterHead').find("select, textarea, input").serialize()).done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function exportCertificateListTally() {
  notice('Loading please wait...', 'info');
  $.post(site_url + 'export/sharecertificatelisttally', $('#filterHead').find("select, textarea, input").serialize()).done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function exportModifiedProfilesTally() {
  notice('Loading please wait...', 'info');
  $.post(site_url + 'export/modifiedprofilestally', $('#filterHead').find("select, textarea, input").serialize()).done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function exportShareMemberRecord() {
  $.post(site_url + 'export/sharememberrecord', $('#filterHead').find("select, textarea, input").serialize()).done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}
function exportNewNidhiEntry() {
  $.post(site_url + 'export/newnidhienntryexport', $('#filterHead').find("select, textarea, input").serialize()).done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function applyShareDates() {
  if ($('#txtShareFrm').val() == '' || $('#txtShareTo').val() == '' || $('#txtShareIssueDate').val() == '') {
    alert('Please fill all the Fields');
    return false;
  }
  myXHR(site_url + 'share/sharedate_', $('#filterHead').find("select, textarea, input").serialize(), 'boxResult');
}

function addToPassbookPrintQueue(nesID) {
  if ($('#passbookPrintQueue').val() != '') {
    $('#passbookPrintQueue').val($('#passbookPrintQueue').val() + '-' + nesID);
  } else {
    $('#passbookPrintQueue').val(nesID);
  }
  $('#searchResults').html('');
  $('#frmBenAdvanceSearch .row input').val('');
  $('#txtOldid').focus();
}

function printPassbookSeries() {
  if ($('#passbookPrintQueue').val() != '') {
    window.open("http://192.168.2.101/demo/beneficiary/makeprintseries/" + $('#passbookPrintQueue').val(), "_blank");
  } else {
    alert('Minimum 2 Beneficiaries Requied');
  }
}

function printPassbookSeriesLegal() {
  if ($('#passbookPrintQueue').val() != '') {
    window.open(site_url + "beneficiary/makeprintserieslegal/" + $('#passbookPrintQueue').val(), "_blank");
  } else {
    alert('Minimum 2 Beneficiaries Requied');
  }
}

function closeAccount(id) {
  $.post(site_url + 'share/nidhicloseaccount_', {
    id: id
  }).done(function(data) {
    alert(data);
    $('#close' + id).remove();
  });
}

function useShare(ids) {
  $('#txtShareId').val(ids);
}

function useCert(ids,range) {
  $('#txtCertOverride').val(ids);
  $('#txtShareId').val(range);
}


function calculateCostPerPoint() {
  $('#txtcostPerPoints').val(((parseInt($('#txtScholarshipAmount').val()) || 0) / parseInt($('#txtPoints').val())).toFixed(2));
}

function updateSpecialPoints(id) {
  $.post(site_url + 'scholarship/update_special', {
    splpt: $('#' + id).val(),
    id: id.replace('txtSplPt', '')
  }).done(function(data) {
    if (data != 'error') {
      $('#btn' + id).css('display', 'none');
      $('#tpoints' + id.replace('txtSplPt', '')).html(data);
    }
  });
}

function updateScolAmt(id) {
  $.post(site_url + 'scholarship/update_amt', {
    amt: $('#' + id).val(),
    id: id.replace('txtAmt', '')
  }).done(function(data) {
    if (data != 'error') {

      $('#btnAmt' + id.replace('txtAmt', '')).removeClass('btn-primary').addClass('btn-success');
      $('#btnAmt' + id.replace('txtAmt', '')).html('updated')
      $('#' + id).val(data);
    }
  });
}

function fetchAbsenties() {
  $.post(site_url + 'attendance/check_validate', {
    emp_no: $('#txtEmpCode').val()
  }).done(function(data) {
    $('#boxResult').html(data);
  });
}

function checkAadharExist() {
  if ($('#txtGuardianAadhaarCheck').val().length == 12) {
    if ( $('#txtGuardianAadhaarCheck').val() != $('#txtGuardianAadhaarCheckfirst').val()){
      alert('Aadhar mismatch');
      return false;
    }
    $.post(site_url + 'guardain/checkaadhar', {
      Gaadhar: $('#txtGuardianAadhaarCheck').val()
    })
    .done(function(data) {
      if (data == '[]') {
        if (confirm('Guardian not found.. add new?')) {
          //location.href=site_url+'guardain/addguardian';
          $.post(site_url + 'headless/beneficiary_search', {
            type: 'nidhiGuard'
          })
          .done(function(data) {
            $('#adhaarCheckStatus').html(data);
          });
        }
      } else {
        guardian = JSON.parse(data);
        var newdt = guardian[0].guardian_dob.split('-');
        $('#txtGuardian').val(guardian[0].guardian_name);
        $('#selGGender').val(guardian[0].guardian_gender);
        $('#txtGuardianAadhaar').val(guardian[0].guardian_aadhar);
        $('#txtGccupation').val(guardian[0].guardian_occupation);
        $('#txtAddrPermnt').val(guardian[0].permanent_address);
        $('#txtGGuardian').val(guardian[0].guardians_guardian);
        $('#txtMembershipID').val(guardian[0].share_member_id);
        $('#txtGDOB').val(newdt[2] + '/' + newdt[1] + '/' + newdt[0]);
        $('#txtBankAC').val(guardian[0].bank_account);
        $('#txtBnkAcHolder').val(guardian[0].bank_account_holder);
        $('#txtBankName').val(guardian[0].bank_name);
        $('#txtBankBranch').val(guardian[0].bank_branch);
        $('#txtIFSC').val(guardian[0].IFSC_code);
        $('#txtPAN').val(guardian[0].pan_card);

        alert('Aadhare Matched with Membership ID: ' + guardian[0].share_member_id);
        $.post(site_url + 'headless/beneficiary_search', {
          type: 'nidhiBen'
        })
        .done(function(data) {
          $('#adhaarCheckStatus').html(data);
        });
        //$('#scapeModal').modal('hide');
      }
    });
  } else {

  }
}

function addToNidhiBen(nes_id) {
  $('#scapeModal').modal('hide');
  $.post(site_url + 'beneficiary/ben_data_json', {
    id: nes_id
  })
  .done(function(data) {
    ben = JSON.parse(data);
    if (ben[0].dob === null) {

    } else {
      var newdt = ben[0].dob.split('-');
      $('#txtDOB').val(newdt[2] + '/' + newdt[1] + '/' + newdt[0]);
    }
    //var newdt = ben[0].dob.split('-');
    $('#old_id').val(ben[0].old_id);
    $('#txtBenName').val(ben[0].name);
    $('#selGender').val(ben[0].gender);
    //$('#txtDOB').val(newdt[2]+'/'+ newdt[1]+'/'+ newdt[0]);
    $('#txtPhone').val(ben[0].phone);
    $('#txtEmail').val(ben[0].email);
    $('#txtAadhaar').val(ben[0].aadhaar);
    $('#txtGuardianRel').val(ben[0].guardian_relation);
    $('#txtNominee').val(ben[0].nominee_name);
    $('#txtNomineeRel').val(ben[0].nominee_relation);
    $('#txtNomineePhone').val(ben[0].nominee_phone);
    $('#txtNomineeAadhaar').val(ben[0].nominee_aadhar);
    $('#txtAddrTemp').val(ben[0].temporary_address);
    $('#txtSchool').val(ben[0].school);
    $('#txtMedium').val(ben[0].medium);
    $('#txtSyllabus').val(ben[0].syllabus);
    $('#txtCollege').val(ben[0].college);
    $('#txtQualification').val(ben[0].qualification);
    $('#selForane').val(ben[0].forane).change();
    $('#setEduFrm').val(ben[0].education_forum);
    $('#txtBCCNum').val(ben[0].bcc_number);
    $('#txtBCCName').val(ben[0].bcc_name);
    $('#old_id').val(nes_id);
    $('#txtId').val(ben[0].id);
    $('.content-header').find('h1 small').html('[' + nes_id + ']');
  });

}

function validateGuardain() {
  var gData = $('#frmAddBeneficiary').serialize();

  $.post(site_url + 'guardain/add_', gData).done(function(data) {


    if (confirm(data + " ! Proceed To Beneficiary Edit ?")) {
      location.href = site_url + 'beneficiary/addnidhi/' + window.location.search;
    } else {
      $('#frmAddBeneficiary')[0].reset();
    }

  });
  return false;
}

function updateGuardain() {
  var gData = $('#frmAddBeneficiary').serialize();
  $.post(site_url + 'guardain/update_', gData).done(function(data) {
    alert(data);
  });
  return false;
}

function createNewGuardian(benid) {
  location.href = site_url + 'guardain/addguardian?stamp=' + Date() + '&gaadhar=' + $('#txtGuardianAadhaarCheck').val() + '&old_id=' + benid;
}

function addNewNidhiBeneficiary() {
  location.href = site_url + 'beneficiary/add/?gaadhar=' + $('#txtGuardianAadhaarCheck').val() + '&stamp=' + Date();
}

function editGuardian(id) {
  location.href = site_url + 'guardain/editguardian?share_memeber_id=' + id + '&stamp=' + Date();
}

function memberSearch() {
  myXHR(site_url + 'share/srchmemberbyidcertid_', $('#filterHead').find("select, textarea, input").serialize(), 'boxResult');
}

function add_fund_corpus() {
  myXHR(site_url + 'corpusfund/addfund', $('#frmaddFund').find("select, textarea, input").serialize(), 'addFundResults');
  return false;
}

function removePhoto(type) {
  $.post(site_url + 'corpusfund/removephoto', 'type=' + type + '&id=' + $('#txtDId').val()).done(function(data) {
    document.location.reload();
  });
}

function removeCorpTrans(vID, transDate, corp_id) {
  if (confirm('Are you sure to delete this transaction ?')) {
    $.post(site_url + 'corpusfund/removetransaction', 'voucher_number=' + vID + '&transaction_date=' + transDate + '&corp_id=' + corp_id).done(function(data) {
      $('#' + vID + transDate).remove();
      $('#scapeModalBody tfoot').remove();
    });
  }
}

function exportCorpusForumwiseAgrigate() {
  $.post(site_url + 'export/corpusForumwiseAggregate').done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function addToCertAck(val){
  $('#searchSuggest').html('');
  $('#searchSuggest').css('display', 'none');
  $('#txtSearch').val('');
  $('#txtSearch').focus();
  $.post(site_url + 'share/sharecertcunterack_', {cert_id:val}).done(function(data) {
    $('#tablecerts').prepend(data);
    $('#txtEntries').val(parseInt($('#txtEntries').val())+1);
  });
}

function fetchAckCert(){
  $('#boxResult').html('<span style="font-size:100px;opacity:0.1;text-align:center;display:block" class="fa fa-cog fa-spin"></span>');
  $.post(site_url + 'xhr/certacklist',$('#filterHead input, select').serialize()).done(function(data) {
    $('#boxResult').html(data);
  });
}
function newNidhiEntryList(){
  $.post(site_url + 'xhr/newnidhientrylist',$('#filterHead input, select').serialize()).done(function(data) {
    $('#boxResult').html(data);
  });
}

function removeFromAck(holder){
  if(confirm('Are you Sure to remove '+holder+' from Share counter acknowledgement list?')){
    $.post(site_url + 'xhr/removecertack',{holder:holder}).done(function(data) {
      if(data == "removed"){
        $('#'+holder).remove();
      }
    });
  }
}

function scolarshipCoursePoints(){
  $.post(site_url + 'export/scolarshipcoursepoints').done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function getYearlyTransaction(oldID){
  $.post(site_url + 'scholarship/yearlyamt',{oldID:oldID}).done(function(data) {
    $('#scolYearlyTran,#yearlyTran2').html(data)
  });
}

function delScholoarshipApplication(genID){
  if(confirm('Are you sure to delete this application ?')){
    $.post(site_url + 'scholarship/deleteapplication',{genID:genID}).done(function(data) {
      if(data == 'deleted'){
        alert('Application '+genID+' Deleted');
        location.href = site_url+'scholarship/newapplication';
      }
    });
  }
}

function curDate(){
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth() + 1; //January is 0!

  var yyyy = today.getFullYear();
  if (dd < 10) {
    dd = '0' + dd;
  }
  if (mm < 10) {
    mm = '0' + mm;
  }
  return dd + '/' + mm + '/' + yyyy;
}

function add_voucher(){
  is_bank_date = false;
  if($('#bank').val() != 'Cash' && $('#transaction_date').val() == curDate()){
    var is_bank_date = confirm('Bank transaction date is set to Todays Date. Proceed ?');
  }else{
    is_bank_date = true;
  }

  if(is_bank_date){
    $.post(site_url + 'accounts/addvoucherentry',$('#frmaddFund').find("select, textarea, input").serialize()).done(function(data) {
      alert(data);
      location.reload();
    });
  }

  return false;
}

function fetchAccountsTranBatch(){
  $('#boxResult').html('');
  fetchAccountsTran('Account Manager 1');
}


function fetchAccountsTran(user=''){
    var param = '';
    if(user!=''){
       param = '&user='+user;
    }

    $.post(site_url + 'accounts/summaryxhr',$('#accSummary').find("select, textarea, input").serialize()+param).done(function(data) {
      if(user == ''){
         $('#boxResult').html(data);
       }else{
         $('#boxResult').append('<h2>'+user+'</h2>'+data);
         if(user != 'Account Manager 3'){
           fetchAccountsTran('Account Manager '+(parseInt(user.split(' ')[2])+1));
         }else if(user == 'Account Manager 3'){
            var sum = 0;
            $('.cashInHand').each(function(){
               sum+=parseFloat($(this).text());
            });
            //really bad code... but there is no other go
           $('#boxResult').append('<br><table id="tblGrandTotal" class="table table-primary table-striped table-bordered" style="width:50%">'+
            '<tbody><tr><th style="background-color:green;width:400px;">Total Cash In Hand</th>'+
            '<td class="GrandTotal"><strong>'+sum.toFixed(2)+'</strong></td></tr></tbody></table>');
         }
       }
    });
}

function getAccountSummaryDetails(user,tran_date,type){
  $('#scapeModalTitle').html('Account Details');
  $('#scapeModalFooter').hide();
  $('#scapeModal').modal('show');
  $.post(site_url + 'accounts/typesummaryxhr','user='+user+'&tran_date='+tran_date+'&type='+type).done(function(data) {
    $('#scapeModalBody').html(data);
    var sum = 0;
  $('#tblTranSummary tr td:nth-child(7)').each(function(){
   sum+=parseFloat($(this).text());
  });

  $('#tblTranSummary tr td:nth-child(1)').each(function(){
    $(this).attr('title','Click to Print');
    $(this).css({"cursor":"pointer","color":"blue"});
    $(this).attr('onclick',"printvoucher('"+$(this).text()+"')");
  });

  $('#tblTranSummary tbody tr:last-child').after('<tr style="background-color:green;color:#ffffff"><td style="text-align:center;font-weight:bold" colspan="6">Total</td><td style="text-align:right;font-weight:bold;">'+sum.toFixed(2)+'</td></tr>');
    });
}

function printvoucher(vid){
  window.open(site_url+'accounts/print/'+vid,'_blank');
}

function accountsTransactionHistory(){
  $.post(site_url + 'accounts/transactionshistory_',$('#accSummary').find("select, textarea, input").serialize()).done(function(data) {
    $('#boxResult').html(data);
    $('#tblTranHistory').DataTable({
      'paging': false,
      'lengthChange': false,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': false
    });
  });
}

function deleteAccountEntry(id){
  if(confirm('Are you sure to delete the entry #'+id+' ?')){
    $.post(site_url + 'accounts/deletetransaction','id='+id).done(function(data) {
      if(data == 'deleted'){
        $('#acc'+id).remove();
      }
    });
  }
}

function accountsFilter(){
  $.post(site_url + 'accounts/filter_',$('#frmAccountsFilter').find("select, textarea, input").serialize()).done(function(data) {
    $('#boxResult').html(data);
    $('#tblTranHistory').DataTable({
      'paging': false,
      'lengthChange': false,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': false
    });
    $('.table-responsive').doubleScroll();
  });
  return false;
}

function calculateIncentive(){
  $.post(site_url + 'accounts/incentive_',$('#frmAccountsIncentive').find("select, textarea, input").serialize()).done(function(data) {
    $('#boxResult').html(data);
    $('#tblTranHistory').DataTable({
      'paging': false,
      'lengthChange': false,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': false
    });
    $('.table-responsive').doubleScroll();
  });
  return false;
}

function accountsFilterExport(){
  $.post(site_url + 'export/accountsfilter',$('#frmAccountsFilter').find("select, textarea, input").serialize()).done(function(data) {
    $('#exportFrame').attr('src', data);
  });
}

function reviewLiveScholarship(id){
  showModal('reviewScholarship',id);
}

function loadScDoc(file){
  var live_url = 'http://navadarsan.com/scholarship/';
  if(file.substr( (file.lastIndexOf('.') +1) ).toLowerCase() == 'pdf'){
    $('#scDocLoader').html('<iframe src="'+live_url+file+'" width="100%" height="500px">');
  }else{
    $('#scDocLoader').html('<div id="scovelray"><img id="ajaxLoader" src ="' + site_url + 'assets/images/loader.gif" /><br>Loading...</div>');
    $('#scDocLoader').append('<img id="scDocs" src="'+live_url+file+'" style="width:100%;height:auto">');
    $('#scDocs').on('load', scDocLoadComplete);
  }
}

function scDocLoadComplete(){
  $('#scovelray').hide();
}
function approveScholarship(id){
  $.post(site_url + 'scholarship/approvescholarship','id='+id).done(function(data) {

  });
}
