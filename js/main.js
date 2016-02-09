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

	this.initEvents();
}

Proches.prototype.initEvents = function() {

	var that = this;

	this.$.editBtn.on('click', function() {

		that.$.formContainer.empty();
		that.$.formContainer.append('<form class="m-t" role="form" id="editProche" method="post"><div class="form-group text"><input type="text" class="form-control" placeholder="Nom" id="name" name="name" required=""></input><input type="text" class="form-control" placeholder="Numéro de téléphone" id="phone" name="phone" required=""></input></div><input type="submit" class="btn btn-primary block full-width m-b" value="Éditer"></form>')

	});

	this.$.deleteBtn.on('click', function() {

		that.$.formContainer.empty();
		$(this).parent().remove();

	});

	this.$.addBtn.on('click', function() {
		that.$.formContainer.empty();
		that.$.formContainer.append('<form class="m-t" role="form" id="addProche" method="post"><div class="form-group text"><input type="text" class="form-control" placeholder="Nom" id="name" name="name" required=""></input><input type="text" class="form-control" placeholder="Numéro de téléphone" id="phone" name="phone" required=""></input></div><input type="submit" class="btn btn-primary block full-width m-b" value="Ajouter"></form>')

	})



}

var proches = new Proches();