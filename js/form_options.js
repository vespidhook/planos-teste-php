$(document).ready(function () {
  $(".add").on("click", function () {
    $("#beneficiarios").append(
      '<div id="beneficiarios">\
      <div class="form-row">\
          <div class="form-group col-md-6">\
          <input type="text" class="form-control" name="beneficiario[nome][]" required>\
          </div>\
          <div class="form-group col-md-2">\
              <input type="number" class="form-control" name="beneficiario[idade][]" required><br>\
          </div>\
          <button type="button" class="delete" value="Remover">Remover</button\
          </div>\
      </div>\
      </div> '
    );
  });
});

$(document).on("click", ".delete", function () {
  $(this).parent().remove();
});

// planos
$(window).on("load", function () {
  $.ajaxSetup({
    async: false,
  });

  var JSONItems = [];
  $.getJSON("json/planos.json", function (data) {
    JSONItems = data;
  });

  var src = $.map(JSONItems, function (item) {
    return {
      label: item.nome,
      value: item.nome,
      codigo: item.codigo,
    };
  });

  $("#registro").autocomplete({
    source: function (request, response) {
      var results = $.ui.autocomplete.filter(src, request.term);

      if (!results.length) {
        results = ["Sem resultados."];
      }

      response(results);
    },
    select: function (event, ui) {
      if (ui.item.label === "Sem resultados.") {
        event.preventDefault();
      } else {
        this.value = ui.item.label;
        $("#plano").val(ui.item.value);
        $("#codigo").val(ui.item.codigo);
      }
    },
  });

  $("#registro").on("keydown", function () {
    if ($(this).val().length > 0) {
      $("#plano").val("");
      $("#codigo").val("");
    }
  });
});

function goForward() {
  window.history.forward();
}
