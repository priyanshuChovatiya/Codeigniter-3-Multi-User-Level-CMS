/* Site BaseUrl */
const BaseUrl = $("meta[name=baseurl]").attr("content");
var services = null;
/* common ajax loader for all ajax call */
$(document).ready(function() {
	$(document).on('change', '.file', function() {
		var input = this;
		if (input.files) {
			var filesAmount = input.files.length;
			for (i = 0; i < filesAmount; i++) {
				var reader = new FileReader();
				reader.onload = function(event) {
					var imageHtml = '<div class="col-md-4"><img src="' + event.target.result + '" class="ms-4 mt-3 rounded" width="200" alt="Image preview"></div>';
					$('.show_image').append(imageHtml);
				}
				reader.readAsDataURL(input.files[i]);
			}
		}
	});
});

function setSrNo(element) {
  element.find(".td-srno").each(function (index) {
    $(this).html(parseInt(index) + 1);
  });
}

$(document).ajaxSend(function (event, jqXHR, { showLoader }) {
  if (showLoader) {
    $.blockUI({
      message: `<div class="sk-wave mx-auto">
                    <div class="sk-rect sk-wave-rect"></div> 
                    <div class="sk-rect sk-wave-rect"></div> 
                    <div class="sk-rect sk-wave-rect"></div> 
                    <div class="sk-rect sk-wave-rect"></div> 
                    <div class="sk-rect sk-wave-rect"></div>
                </div>`,
      css: {
        backgroundColor: "transparent",
        border: "0",
      },
      overlayCSS: {
        opacity: 0.5,
      },
    });
  }
});
$(document).ajaxComplete(() => $.unblockUI());
/* common loader  */
function ShowBlockUi(selector, timer = 1000) {
  $(selector).block({
    message: '<div class="spinner-border text-primary" role="status"></div>',
    timeout: timer,
    css: {
      backgroundColor: "transparent",
      border: "0",
    },
    overlayCSS: {
      backgroundColor: "#fff",
      opacity: 0.8,
    },
  });
}
/* For get Form data on id */
const getAllFormData = (Forms) => {
  const Response = {};
  const apid = {};
  Forms.forEach((form) => {
    var formElementArray = $(`#${form}`).serializeArray();
    var structuredData = {};
    var test = {};
    formElementArray.forEach(({ name, value }) => {
      if (name.endsWith("[]")) {
        const nameKey = name.slice(0, -2);
        if (!structuredData[nameKey]) {
          structuredData[nameKey] = [];
        }
        if (nameKey == "params") {
          test[nameKey] = value;
        }
        structuredData[nameKey].push(value);
      } else {
        structuredData[name] = value;
      }
    });
    apid["params"] = test;
    Response[form] = structuredData;
  });
  return {
    apid: apid,
    response: Response,
  };
};
function getService(selected_id = null, html = true) {
  if (localStorage.getItem("services") === null) {
    $.ajax({
      type: "get",
      url: `${BaseUrl}get-services`,
      success: function (response) {
        var { success, data } = JSON.parse(response);
        if (success) {
          localStorage.setItem("services", JSON.stringify(data));
        }
      },
      error: function (error) {
        throw Error(error);
      },
    });
  }
  services = JSON.parse(localStorage.getItem("services"));
  if (html) {
    var options = {
      value: "id",
      format: "name",
      selected_id: selected_id,
      default: false,
    };
    return (optionHTML = getOptions(services, options));
  } else {
    return services;
  }
}
/* Common Sweet alert for right side top corner */
const SweetAlert = function (type, message) {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
  });
  Toast.fire({
    icon: type,
    title: message,
  });
};

/* For switch element  */
/* label in switch on ---> data-on */
/* label in switch off ---> data-off */

$(document).on("click change", ".switch-input", function () {
  var label = $(this).is(":checked") ? $(this).data("on") : $(this).data("off");
  $(this).siblings(".switch-label").html(label);
});
$(".switch-input").change();
/* Common asked Sweetalert */
const alert_if = function (
  message = "You won't be able to revert this!",
  callBack,
  failure = null
) {
  Swal.fire({
    title: "Are you sure ?",
    text: message,
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes!",
    customClass: {
      confirmButton: "btn btn-primary me-3 waves-effect waves-light",
      cancelButton: "btn btn-outline-secondary waves-effect",
    },
    buttonsStyling: false,
  }).then(function (result) {
    if (result.value) {
      callBack();
    } else {
      if (failure != null) {
        failure();
      }
    }
  });
};
$(document).on("click", ".resetBtn", function (e) {
  e.preventDefault();
  Swal.fire({
    title: "Are you sure to reset?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes, reset!",
    customClass: {
      confirmButton: "btn btn-primary me-3 waves-effect waves-light",
      cancelButton: "btn btn-outline-secondary waves-effect",
    },
    buttonsStyling: false,
  }).then(function (result) {
    if (result.value) {
      $("form")[0].reset();
      $(".select2").val(null).trigger("change");
      $("form").find(".required").each(function () {
        $(this).removeClass("input-error");
      });
			$('.error-message').each(function(){
				$(this).remove(); 
			})
      SweetAlert("success", "Your Form Reset Successfully!!");
    }
  });
});
const getOptions = function (response, props) {
  var options = "";
  var selected = "";
  if (props.default) {
    options += `<option value=""> --- SELECT ---</option>`;
  }
	var selectedIdsArray = props.selected_id ? props.selected_id.split(',') : [];
  $.each(response, function (key, value) {
    // selected = props.selected_id != null && props.selected_id == value.id ? "selected" : " ";
			selected = selectedIdsArray.includes(value.id.toString()) ? "selected" : "";

    if (props.format) {
      const parts = props.format.split("-");
      let label = "";
      $.each(parts, function (i, part) {
        if ($.inArray(part, value)) {
          label +=
            part == "city_name" ? `( ${value[part]} )` : value[part] + " ";
        } else {
          label += value.name;
        }
      });
      options += `<option value="${value.id}" ${selected}>${label}</option>`;
    } else {
      options += `<option value="${value["id"]}" ${selected}>${value["name"]}</option>`;
    }
  });
  return options;
};

const getCustomer = function (city_id,selected_id = null) {
  $.ajax({
    url: `${BaseUrl}admin/User/getCustomers`,
    type: "POST",
    dataType: "json",
		data: {
			city_id: city_id,
		},
    success: function (response) {
      $(".getCustomer").empty();
      var options = {
        value: "id",
        format: "name-city_name",
        selected_id: selected_id,
        default: true,
      };
      var optionHTML = getOptions(response, options);
      $(".getCustomer").html(optionHTML);
    },
  });
};
const getVendor = function (city_id,selected_id = null) {
  $.ajax({
    url: `${BaseUrl}admin/User/getVendor`,
    type: "POST",
    dataType: "json",
    data: {
      city_id: city_id,
    },
    success: function (response) {
      $(".getVendor").empty();
      var options = {
        format: "name-city_name",
        selected_id: selected_id,
        default: true,
      };
      var optionHTML = getOptions(response, options);
      $(".getVendor").html(optionHTML);
    },
  });
};
const getWorker = function (city_id,selected_id = null) {
  $.ajax({
    url: `${BaseUrl}admin/User/getWorker`,
    type: "POST",
    dataType: "json",
		data: {
			city_id: city_id,
		},
    success: function (response) {
      $(".getWorker").empty();
      var options = {
        format: "name-city_name",
        selected_id: selected_id,
        default: true,
      };
      var optionHTML = getOptions(response, options);
      $(".getWorker").html(optionHTML);
    },
  });
};

/* Common user get with ajax with Select2 */
$(document).ready(function () {
  $(".searchUser").select2({
    placeholder: "Search user by name, mobile, email, id.",
    minimumInputLength: 1,
    ajax: {
      url: `${BaseUrl}admin/searchUser`,
      type: "post",
      dataType: "json",
      delay: 250,
      processResults: function (data) {
        return {
          results: $.map(data, function (item) {
            return {
              text: `${item.id} ${item.name} ( ${item.user_type} )`,
              id: item.id,
            };
          }),
        };
      },
      cache: true,
    },
  });
});
$(document).keydown(function (e) {
  if (e.altKey && e.key === "d") {
    window.location = `${BaseUrl}admin/dashboard`;
  }
});
/* Convert price in word */
function price_in_words(price) {
  var sglDigit = [
      "Zero",
      "One",
      "Two",
      "Three",
      "Four",
      "Five",
      "Six",
      "Seven",
      "Eight",
      "Nine",
    ],
    dblDigit = [
      "Ten",
      "Eleven",
      "Twelve",
      "Thirteen",
      "Fourteen",
      "Fifteen",
      "Sixteen",
      "Seventeen",
      "Eighteen",
      "Nineteen",
    ],
    tensPlace = [
      "",
      "Ten",
      "Twenty",
      "Thirty",
      "Forty",
      "Fifty",
      "Sixty",
      "Seventy",
      "Eighty",
      "Ninety",
    ],
    handle_tens = function (dgt, prevDgt) {
      return 0 == dgt
        ? ""
        : " " + (1 == dgt ? dblDigit[prevDgt] : tensPlace[dgt]);
    },
    handle_utlc = function (dgt, nxtDgt, denom) {
      return (
        (0 != dgt && 1 != nxtDgt ? " " + sglDigit[dgt] : "") +
        (0 != nxtDgt || dgt > 0 ? " " + denom : "")
      );
    };

  var str = "",
    digitIdx = 0,
    digit = 0,
    nxtDigit = 0,
    words = [];
  if (((price += ""), isNaN(parseInt(price)))) str = "";
  else if (parseInt(price) > 0 && price.length <= 10) {
    for (digitIdx = price.length - 1; digitIdx >= 0; digitIdx--)
      switch (
        ((digit = price[digitIdx] - 0),
        (nxtDigit = digitIdx > 0 ? price[digitIdx - 1] - 0 : 0),
        price.length - digitIdx - 1)
      ) {
        case 0:
          words.push(handle_utlc(digit, nxtDigit, ""));
          break;
        case 1:
          words.push(handle_tens(digit, price[digitIdx + 1]));
          break;
        case 2:
          words.push(
            0 != digit
              ? " " +
                  sglDigit[digit] +
                  " Hundred" +
                  (0 != price[digitIdx + 1] && 0 != price[digitIdx + 2]
                    ? " and"
                    : "")
              : ""
          );
          break;
        case 3:
          words.push(handle_utlc(digit, nxtDigit, "Thousand"));
          break;
        case 4:
          words.push(handle_tens(digit, price[digitIdx + 1]));
          break;
        case 5:
          words.push(handle_utlc(digit, nxtDigit, "Lakh"));
          break;
        case 6:
          words.push(handle_tens(digit, price[digitIdx + 1]));
          break;
        case 7:
          words.push(handle_utlc(digit, nxtDigit, "Crore"));
          break;
        case 8:
          words.push(handle_tens(digit, price[digitIdx + 1]));
          break;
        case 9:
          words.push(
            0 != digit
              ? " " +
                  sglDigit[digit] +
                  " Hundred" +
                  (0 != price[digitIdx + 1] || 0 != price[digitIdx + 2]
                    ? " and"
                    : " Crore")
              : ""
          );
      }
    str = words.reverse().join("");
  } else str = "";
  return str;
}
/* Comman form validation */
$("form").on("submit", function (e) {
  let isValid = true;
  $(this)
    .find(".required")
    .each(function () {
      if ($(this).val().trim() === "") {
        $(this).addClass("input-error");
        if ($(this).parent().next(".error-message").length == 0) {
          $(this).parent().after("<div class='error-message text-danger'></div>");
          if ($(this).hasClass("select2")) {
            var dataLabelValue = $(this).data("lable");
            $(this)
              .parent()
              .next(".error-message")
              .html(dataLabelValue + " field is required.<br>");
          } else {
            $(this)
              .parent()
              .next(".error-message")
              .html(
                $(this).siblings("label").text() + " field is required.<br>"
              );
          }
        }
        isValid = false;
      } else {
        $(this).removeClass("input-error");
        $(this).parent().next(".error-message").html("");
      }
    });
  if (!isValid) {
    e.preventDefault();
  }
});
/* common Jquery validation for all input just add */
jQuery.validator.setDefaults({
  debug: false,
  ignore: ":hidden:not(.required)",
  ignoreTitle: true,
  errorPlacement: function(error, element) {
    if (element.closest('.form-floating').length) {
        error.insertAfter(element.closest('.form-floating'));
    } else {
        error.insertAfter(element); // default error placement
    }
}
});
/* For Mobile Number Validation */
jQuery.validator.addMethod(
  "mobileCheck",
  function (value, element) {
    return this.optional(element) || /^[0-9]{10}$/i.test(value);
  },
  "Please enter valid mobile."
);
/* Positive Number Validation */
jQuery.validator.addMethod(
  "positiveNumber",
  function (value, element) {
    return this.optional(element) || value >= 0;
  },
  "Please enter a positive number."
);
/* For Email Validation */
jQuery.validator.addMethod(
  "emailCheck",
  function (value, element) {
    return (
      this.optional(element) ||
      /^[A-Z0-9][A-Z0-9\._\-]+@(?:[A-Z0-9][A-Z0-9_\-]+)\.(?:[A-Z0-9][A-Z0-9_\-]{1,9})(?:(?:\.[A-Z0-9]{2,5})?)$/i.test(
        value
      )
    );
  },
  "Please enter valid email address."
);
jQuery.validator.addMethod(
  "emailCheck1",
  function (value, element) {
    return (
      this.optional(element) ||
      /^[A-Z0-9][A-Z0-9\._\-]+@(?:[A-Z0-9][A-Z0-9_\-]+)\.(?:[A-Z0-9][A-Z0-9_\-]{1,9})(?:(?:\.[A-Z0-9]{2,5})?)$/i.test(
        value
      )
    );
  },
  "Please enter valid email address."
);
/* Matches Italian postcode (CAP) */
jQuery.validator.addMethod(
  "pincodeCheck",
  function (value, element) {
    return this.optional(element) || /^\d{6}$/.test(value);
  },
  "Please specify a valid postal code"
);
/* Matches Italian postcode (CAP) */
jQuery.validator.addMethod(
  "maxLength",
  function (value, element, params) {
    return this.optional(element) || value.length <= params;
  },
  jQuery.validator.format("Maximum {0} characters allowed.")
);
/* For Pancard Validation */
jQuery.validator.addMethod(
  "checkPAN",
  function (value, element) {
    return (
      this.optional(element) ||
      /^[A-Za-z]{5}([0-9]{4})[A-Za-z]{1}$/i.test(value)
    );
  },
  "Invalid PAN No."
);
/* For Aadhaar card validation */
jQuery.validator.addMethod(
  "checkAdhaar",
  function (value, element) {
    return (
      this.optional(element) || /^[0-9]{4}-[0-9]{4}-[0-9]{4}$/i.test(value)
    );
  },
  "Invalid Adhaar No."
);
/* For GSTNumber Check validation */
jQuery.validator.addMethod(
  "checkGSTIN",
  function (value, element) {
    return (
      this.optional(element) ||
      /^[0-9][0-9][A-Za-z]{5}([0-9]{4})[A-Za-z]{1}[0-9][a-z][0-9a-z]$/i.test(
        value
      )
    );
  },
  "Invalid GST No."
);
jQuery.validator.addMethod(
  "checkCallback",
  function (value, element) {
    return this.optional(element) || /^[a-z]([a-z0-9])*$/i.test(value);
  },
  "Callback must start with alphabets and contains only alpha numeric value."
);
/* Check for alphanumericCheck value validation */
jQuery.validator.addMethod(
  "alphanumericCheck",
  function (value, element) {
    return this.optional(element) || /^[a-z0-9]+$/i.test(value);
  },
  "Only letters and numbers are allowed."
);
/* Class Rules for Validation */
jQuery.validator.addClassRules({
  requiredCheck: {
    required: true,
  },
  requiredCheck1: {
    required: {
      depends: function (el) {
        var finalReturn = false;
        $.each($(el).parents("tr").find("input"), function (k, v) {
          console.log($(v).val());
          if ($(v).val() != "" && $(v).val() != 0) {
            finalReturn = true;
          }
        });
        return finalReturn;
      },
    },
  },
  password: {
    required: true,
    minlength: 8,
  },
  confirmPassword: {
    required: true,
    equalTo: "#txtPassword",
  },
  confirmPayoutBankAccountNo: {
    required: true,
    equalTo: "#txtPayoutBankAccountNo",
  },
  confirmPIN: {
    required: true,
    equalTo: "#txtPIN",
  },
  pin: {
    required: true,
    digits: true,
    maxLength: 4,
  },
  onlyDigits: {
    required: true,
    digits: true,
  },
  alphanumeric: {
    required: true,
    alphanumericCheck: true,
  },
  onlyDigits1: {
    digits: true,
  },
  isDecimal: {
    number: true,
  },
  mobileCheck: {
    required: true,
    mobileCheck: 10,
  },
  requiredInput: {
    required: true,
  },
  mobileCheck1: {
    mobileCheck: 10,
    required: true,
  },
  emailCheck: {
    required: true,
    emailCheck: true,
  },
  emailCheck1: {
    emailCheck: true,
  },
  max: {
    max: function (element) {
      return Number($(element).attr("data-max"));
    },
  },
  maxLength: {
    maxLength: function (element) {
      return Number($(element).attr("data-max"));
    },
  },
  pincodeCheck: {
    pincodeCheck: true,
  },
  checkPAN: {
    checkPAN: true,
  },
  checkAdhaar: {
    checkAdhaar: true,
  },
  checkGSTIN: {
    checkGSTIN: true,
  },
  checkCallback: {
    checkCallback: true,
  },
  positiveNumber: {
    positiveNumber: {
      depends: (e) => {},
    },
    number: true,
  },
});
/* for Make Custom Message for every Input */
jQuery.validator.messages.required = function (param, input) {
  if (
    $(input).hasClass("requiredCheck") ||
    $(input).hasClass("requiredCheck1")
  ) {
    var requiredMessage = "Please select {field}";
    return requiredMessage.replace(
      "{field}",
      input.hasAttribute("data-validation-name")
        ? input.getAttribute("data-validation-name").toLowerCase()
        : input.getAttribute("placeholder").toLowerCase()
    );
  } else {
    var requiredMessage = "Please enter {field}";
    return requiredMessage.replace(
      "{field}",
      input.hasAttribute("data-validation-name")
        ? input.getAttribute("data-validation-name").toLowerCase()
        : input.getAttribute("placeholder").toLowerCase()
    );
  }
};
/* Form Validation Just addde  "validateForm" class of your submit button*/
$(".validateForm").on("click", function (e) {
  $(this).parents("form").valid();
});
/* Form reset and remove all error Validation Tag */
$(".validateForm-reset").on("click", function () {
  var form = $(this).parents("form");
  form.find("label.error").each(function (e) {
    if ($(this).hasClass("error")) $(this).removeClass("error").remove();
  });
});
/* For general log Button */
$(document).on("click", ".info-btn", function () {
  var message = $(this).data("title");
  Swal.fire({
    title: "<strong>Response</strong>",
    icon: "info",
    html: message,
    showCloseButton: true,
    focusConfirm: false,
    confirmButtonText: '<i class="mdi mdi-thumb-up-outline me-2"></i> Ok',
    confirmButtonAriaLabel: "Thumbs up, great!",

    customClass: {
      confirmButton: "btn btn-primary me-3 waves-effect waves-light",
    },
    buttonsStyling: false,
  });
});
