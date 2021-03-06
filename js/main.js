
function Proches() {
  this.init();
}

Proches.prototype.init = function() {

  this.$ = {};

  this.$.container     = $('.wrapper-content')
  this.$.editBtn       = this.$.container.find('.btn-edit');
  this.$.deleteBtn     = this.$.container.find('.btn-delete');
  this.$.addBtn        = this.$.container.find('.btn-add')
  this.$.formContainer = this.$.container.find('.form-proches');
  this.$.form          = this.$.formContainer.find('form');
  this.$.actionBtn     = this.$.formContainer.find('.btn-action');
  this.$.formName      = this.$.formContainer.find('.form-name');
  this.$.formNumber    = this.$.formContainer.find('.form-number');

  this.initEvents();
}

Proches.prototype.initEvents = function() {

  var that = this;

  this.$.editBtn.on('click', function() {

    var number       = $(this).prev().children('.number').text(),
        numberSliced = number.slice(2, -1),
        id           = $(this).parent().attr('data-id'),
        name         = $(this).prev().children('strong').text();

    that.$.formName.val(name);
    that.$.formNumber.val(numberSliced);
    that.$.form.attr('data-number', numberSliced);
    that.$.form.attr('data-name', name);
    that.$.form.attr('data-id', id);
    that.$.form.attr('data-action', 'editProche');
    that.$.actionBtn.html('Éditer');

    that.$.form.fadeIn();

  });

  this.$.deleteBtn.on('click', function() {


    that.$.formContainer.empty();
    $(this).parent().remove();

  });

  this.$.addBtn.on('click', function() {

    that.$.form.attr('data-number', '');
    that.$.form.attr('data-name', '');
    that.$.form.attr('data-id', '');
    that.$.form.attr('data-action', 'addProche');
    that.$.actionBtn.html('Ajouter');

    that.$.form.fadeIn();

  })

}


var proches = new Proches();