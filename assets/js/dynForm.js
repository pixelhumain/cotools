dynForm = {
	
	//TODO 
	/*
	totest : set prefix to a channel 
	totest : add a new channel as an element 
	totest : check member joining 
	totest : how does a member join a private chat ? 
	totest : add external chat
	?? : when adding a new channel , add all memebers ?
	change le slug ???
	check existance 
	create private rooms with role access
	quel politique d'affichage des chats public 
	*/

    jsonSchema : {
	    title : tradDynForm.addNewTool,
	    icon : "th",
	    onLoads : {
	    	onload : function(data){
	    		dyFInputs.setHeader("bg-azure");
				$("#btn-submit-form,.titletext, .urltext, .publicBtntagList,.publicInfocustom").hide();
				$("#ajaxFormModal #title, #ajaxFormModal #url").blur(function() { dyFObj.elementObj.dynForm.jsonSchema.canSubmitIf(); });
				
				if(contextData != null && contextData.type && contextData.id){
					dyFInputs.setSub("bg-azure");
					if( contextData.slug )
						$("#ajaxFormModal #parentSlug").val(contextData.slug);
				}
	    	}
	    },
	    save : function () { 
	    	alert("save tools."+$("#ajaxFormModal #what").val()+".name : "+$("#ajaxFormModal #title").val())
	    	dyFObj.closeForm();
	    },
	    canSubmitIf : function () { 
	    	 if ( $("#ajaxFormModal #what").val() && $("#ajaxFormModal #title").val() != "" )  
	    	 	 $("#btn-submit-form").show();
	    	 else 
	    	 	$("#btn-submit-form").hide(); 
	    },
	    afterSave : function(){
			dyFObj.closeForm();
		    urlCtrl.loadByHash( location.hash );
	    },
	    actions : {
	    	clear : function() {
	    		$(".breadcrumbcustom").html("");
	    		$(".publicInfocustom").html(tradDynForm.publicCahnnelExplain);
	    		$(".whatBtntagList").show(); 
	    		$("#ajaxFormModal #title, #ajaxFormModal #url, #ajaxFormModal #what").val("");
	    		$(".titletext, .urltext,.publicBtntagList,.publicInfocustom").hide();
	    		$("#btn-submit-form").hide(); 
	    	}
	    },
	    properties : {
	    	info : {
                inputType : "custom",
                html:"<p><i class='fa fa-info-circle'></i> "+tradDynForm.infocreateurl+".</p>",
            },
            breadcrumb : {
                inputType : "custom",
                html:"",
            },
           
            parentId : dyFInputs.inputHidden(  ),
            parentType : dyFInputs.inputHidden(  ),
            parentSlug : dyFInputs.inputHidden(  ),

            whatBtn :{
                label : "type of tool ? ",
	            inputType : "tagList",
                list :  {
                	  "chat" : { labelFront:"Chat", icon : "comments" },
					  "wiki" : { labelFront:"Wiki", icon : "wikipedia-w" },
					  "dda" : { labelFront:"Decision Tools", icon : "gavel" },
					  "budgettool" : { labelFront:"Budget Tools", icon : "money" },
					  "drive" : { labelFront:"Cloud Drive", icon : "cloud-download" },
					  "Pad" : { labelFront:"Editor Pad", icon : "edit" },
					  "repository" : { labelFront:"code repo", icon : "code" },
					  "rss" : { labelFront:"RSS", icon : "rss" },
					  "calednar" : { labelFront:"Calendar", icon : "calendar" },
					  "other" : { labelFront:"Other", icon : "question-circle-o" },
			    },
                init : function() {
                	$(".whatBtn").off().on("click",function()
	            	{
	            		$("#ajaxFormModal #what").val( $(this).data('key') );
	            		$(".titletext,.urltext,.publicBtntagList,.publicInfocustom").show();
	            		
	            		$(".whatBtntagList").hide();
	            		$(".breadcrumbcustom").html( "<h4><a href='javascript:;'' class='btn btn-xs btn-danger'  onclick='dyFObj.elementObj.dynForm.jsonSchema.actions.clear()'><i class='fa fa-times'></i></a> "+$(this).data("tag")+"</h4>");	            		
	            	});
	            }
            },
            what : dyFInputs.inputHidden(),
            publicBtn :{
                label : "public or private ? ",
	            inputType : "tagList",
                list :  {
			        "public"  : { labelFront:"Public", icon : "unlock",class:"active" },
			        "private"  : { labelFront:"Private", icon : "lock"}
			    },
                init : function() {
                	$(".publicBtn").off().on("click",function()
	            	{
	            		$("#ajaxFormModal #public").val( $(this).data('key') );
	            		$(".publicBtn").removeClass('active');	
	            		$(".publicInfocustom").html( ( $(this).data('key') == "public" ) ? tradDynForm.publicChannelExplain : tradCategory.privateChannelExplain );
	            		$(this).addClass('active');
	            	});
	            }
            },
            publicInfo : { inputType : "custom", html: tradDynForm.publicChannelExplain},
            public : dyFInputs.inputHidden(),
            title : dyFInputs.inputText(tradDynForm["name"], tradDynForm["channelName"], { required : true }),
            url : dyFInputs.inputUrl(),
            

	    }
	}
};