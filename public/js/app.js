$(".file").change(function() {
    var file = $(".file").val().replace('C:\\fakepath\\', '');
    $(".fileName").text(file);
});


//JOB SCROLL
var scrollable = true;
if($('.job').length > 0) {
	window.onscroll = function(ev) {
    	if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight - 500 && scrollable) {
       	//load new jobs
			scrollable=false;
			var data = { start: $('.job').length };
			$.ajax({
			  url: "/api/v1/jobs/load",
			  data: data,
			  success: function(data) {
				  if(data.jobs.length > 0) {
					for(key in data.jobs) {
						$('.joblist').append("<a href='/jobs/" + data.jobs[key].id + "'><div class='row job white'><div class='large-12 small-12 column'><strong>" + data.jobs[key].functie + " - " + data.jobs[key].werkgever + "</strong><br><p>Description</p></div></div></a>");
						scrollable=true;
					}
				  } else {
					  $("#load").html("Dit waren alle jobs!");
				  }
			  }
			});
		}
	}
}

if($('.project').length>0) {
	window.onscroll = function(ev) {
		if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight - 500 && scrollable && window.location.pathname == "/projects") {
			var data = { start: $('.project').length };
			scrollable=false;
			$.ajax({
			  url: "/api/v1/projects/load",
			  data: data,
			  success: function(data) {
				  if(data.projects.length > 0) {
					for(key in data.projects) {
						var voted=false;;
						for(vote in data.projects[key].votes){
							if(data.projects[key].votes[vote].user_id==$('#auth').data('auth'))
								voted=true;

						}
						var votes = data.projects[key].votes.length;
						var comments = data.projects[key].comments.length;

						var item = "<li class='medium-4 columns project'><a href='projects/"+data.projects[key].id+"'><div class='canvas-medium'><img src='"+data.projects[key].image+"' alt='"+data.projects[key].name+"'></div></a><div class='comments'><img class='icon' src='/img/svgs/fi-comment.svg'>"+comments+"</div>";
						if(voted) {
							item+= "<div class='voting'><a class='unvoteProject' data-project='"+data.projects[key].id+"' href='projects/unvote/"+data.projects[key].id+"'><img class='icon' src='img/svgs/fi-heart-red.svg'></a><span class='totalVotes'>"+votes+"</span></div>";
						} else {
							item+= "<div class='voting'><a class='voteProject' data-project='"+data.projects[key].id+"' href='projects/vote/"+data.projects[key].id+"'><img class='icon' src='img/svgs/fi-heart.svg'></a><span class='totalVotes'>"+votes+"</span></div>";
						}

						item+= "<p class='titel'>"+data.projects[key].name+"</p><p class='eigenaar'>Door <a href='profile/"+data.projects[key].id+"'>"+data.projects[key].user.firstname+" "+data.projects[key].user.name+"</a> van klas "+data.projects[key].user.class+"</p></li>";

						$('#projects').append(item);
					}
					scrollable=true;
					  $(".voting a").on('click', null);
					  $(".voting a").on('click', voting);
				  } else {
					  $("#load").html("Dit waren alle projecten!");
				  }
			  }
			});
		}
	}
}

/* NAV */
$(window).scroll(function() {
	if ($(window).scrollTop() > 0 ){
		$(".top-bar").css("background-color", "#f4f4f4");
		$(".dropdown").css("background-color", "#f4f4f4");
		$(".expanded .title-area").css("background-color", "#f4f4f4");
	}else{
		$(".top-bar").css("background-color", "#e1e3e4");
		$(".dropdown").css("background-color", "#e1e3e4");
		$(".expanded .title-area").css("background-color", "#e1e3e4");
	}
});

$(".top-bar [href]").each(function() {
	if (this.href == window.location.href) {
	    $(this).addClass("active");
	    $(".has-dropdown a").css("font-weight", "normal");
	}
});

/* AJAX */

function voting(e) {
	e.preventDefault();
	var id = $(this).data();

	if ($(this).hasClass("voteProject")) {

	$.ajax({url: "/projects/ajax_vote", data: {project_id: id}, type: "POST", dataType: 'json'})
		.done(function(result) {
			if(result.status == "success")
			{
				$('[data-project='+result.project+']').closest(".project").find(".totalVotes").html(result.votes);
				$('[data-project='+result.project+']').children("img").attr("src", "/img/svgs/fi-heart-red.svg");
				$('[data-project='+result.project+']').attr("href", "/projects/unvote/"+result.project);
				$('[data-project='+result.project+']').removeClass("voteProject");
				$('[data-project='+result.project+']').addClass("unvoteProject");
			}
		});

	} else {

	$.ajax({
		url: "/projects/ajax_unvote",
		data: {project_id: id},
		type: "POST",
		dataType: 'json'})
		.done(function(result) {
			if(result.status == "success")
			{
				$('[data-project='+result.project+']').closest(".project").find(".totalVotes").html(result.votes);
				$('[data-project='+result.project+']').children("img").attr("src", "/img/svgs/fi-heart.svg");
				$('[data-project='+result.project+']').attr("href", "/projects/vote/"+result.project);
				$('[data-project='+result.project+']').removeClass("unvoteProject");
				$('[data-project='+result.project+']').addClass("voteProject");
			}
		});
	}
}

$(".voting a").on('click', voting);

$(".commentButton").on('click', function(e) {
	e.preventDefault();
	var id = $(this).data("project");
	var text = $('textarea').val();

	$.ajax({url: "/projects/ajax_comment", data: {project_id: id, text: text}, type: "POST", dataType: 'json'})
		.done(function(result) {
			if(result.status == "failed")
			{
				//FAILED
			} else {
				$('ul.comments').prepend("<li class='added' data-comment="+result.comment.id+" style='display: none;'><a href='/profile/"+result.user.id+"' class='avatar-small'><img src="+result.user.avatar+"></a><div class='avatar-small-info'><a href='/profile/"+result.user.id+"'><p class='titel'>"+ result.user.firstname + " " + result.user.name + "</p></a><p>"+ result.comment.text +"</p></div><a href='/comments/delete/"+result.comment.id+"' class='commentdel'><div class='commentactions'></div></a></li>");
				$('.added:first').fadeIn('slow');
				$('#comments-titel').html(result.comment_count +" commentaren");
				$('textarea').val("");
				$(".commentdel").on("click", null);
				$(".commentdel").on("click", deletecomment);
			}
		});

});

$(".commentdel").on("click", deletecomment);

function deletecomment(e) {
	e.preventDefault();
	var el = $(this);
	$.ajax({url: "/projects/ajax_delete_comment", data: {id: $(this).parent().data('comment'), authorid: $('h3').data('author'), projectid: $('input').data('project')}, type: "POST", dataType: 'json'})
		.done(function(result) {
			$('li[data-comment="'+result.comment+'"]').remove();
			$('#comments-titel').html(result.commentcount + " Commentaren");
		});
}

$("#filter").on("change", function(e) {
	e.preventDefault();
	var order = $(".order").val();
	var category = $(".category").val();

	$.ajax({
		url: "/projects/ajax_order",
		data: {order: order, category: category},
		type: "POST",
		dataType: 'json'})
		.done(function(result) {
			if(result.status == "success")
			{
				$(".project").fadeOut("slow", function(){
					$(this).remove();
				});
				var knop = "";

				result.projects.forEach(function(project){
					if(result.id){
						knop = "<a class='voteProject' data-project='"+project.id+"' href='projects/vote/"+project.id+"'><img class='icon' src='img/svgs/fi-heart.svg'></a>";
						project.votes.forEach(function(vote){
							if (vote.user_id == result.id) {
								knop = "<a class='unvoteProject' data-project='"+project.id+"' href='projects/unvote/"+project.id+"'><img class='icon' src='img/svgs/fi-heart-red.svg'></a>";
							}else{
								knop = "<a class='voteProject' data-project='"+project.id+"' href='projects/vote/"+project.id+"'><img class='icon' src='img/svgs/fi-heart.svg'></a>";
							}
						});
					}else{
						knop = "<img class='icon' src='img/svgs/fi-heart.svg'>";
					}

					$("#projects").append(
						"<li class='medium-4 columns project'>"+
							"<a href='projects/"+project.id+"'>"+
								"<div class='canvas-medium'>"+
									"<img src='"+project.image+"'>"+
								"</div>"+
							"</a>"+
							"<div class='comments'>"+
								"<img class='icon' src='/img/svgs/fi-comment.svg'>"+
								project.comments.length+
							"</div>"+
							"<div class='voting'>"+
								knop+
								"<span class='totalVotes'>"+project.votes.length+"</span>"+
							"</div>"+
							"<p class='titel'>"+project.name+"</p>"+
							"<p class='eigenaar'>"+
								"Door <a href='profile/"+project.user_id+"'>"+project.user.firstname+" "+project.user.name+"</a>"+
								" van klas "+project.user.class +
							"</p>"+
						"</li>"
					).hide().fadeIn();
					$(".voting a").on('click', null);
					$(".voting a").on('click', voting);
				});
			}
		});
});

if($('input[name=type]:checked', '#signup').val() == 1){
	$(".classinput").hide();
	$(this).removeClass("notselected");
	$(this).prev().addClass("notselected");
}

$(".radio").on("change", function() {
	if($('input[name=type]:checked', '#signup').val() == 1){
		$(this).removeClass("notselected");
		$(this).prev().addClass("notselected");
		$(".classinput").hide();
	} else {
		$(this).removeClass('notselected');
		$(this).next().addClass('notselected');
		$(".classinput").show();
	}
});

$(".award").on("click", function(e){
	e.preventDefault();
	var title = $(this).children("img").data("title");
	var description = $(this).children("img").data("description");
	$(".awardInfo .titel").text(title);
	$(".awardInfo .description").text(description);
	$(".awardInfo").show();
});

/* INDEX RECAPS */
$("#recap li").on("click", function(){
	var item = $(this).data("item");

	if (item == "first") {
		$("#info p").html("1. Meld je aan");
	}else if(item == "second"){
		$("#info p").html("2. Onderscheid jezelf");
	}else if(item == "third"){
		$("#info p").html("3. Vind een job");
	}else if(item == "fourth"){
		$("#info p").html("4. Plan een evenement in");
	}
});

/* SEARCH */
$("#search").keyup(function() {
	var input = $(this).val();

	$.ajax({
		url: "/students/ajax_search",
		data: {username: input},
		type: "POST",
		dataType: 'json'})
		.done(function(result) {
			if(result.status == "success")
			{
				$(".student").fadeOut("slow", function(){
					$(this).remove();
				});

				result.users.forEach(function(user){
					$("#students").append(
						"<li class='medium-3 columns student'>"+
							"<a href='/profile/"+user.id+"'>"+
								"<div class='canvas-medium'>"+
									"<img src='"+user.avatar+"'>"+
								"</div>"+
								"<span class='username'>"+user.firstname+" "+user.name+"</span>"+
							"</a>"+
						"</li>"
					).hide().fadeIn();
				});
			}
		});
});
