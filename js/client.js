// function sendemail()
// {
//     var url = 'client.php';
//
//     new Ajax.Request(url,{
//         onComplete:function(transport)
//         {
//             var feedback = transport.responseText.evalJSON();
//             if(feedback.result==0)
//                 alert('There was a problem sending the email, please try again.');
//         }
//     });
//
// }