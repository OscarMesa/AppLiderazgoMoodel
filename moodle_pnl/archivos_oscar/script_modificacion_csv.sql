144 Query	SELECT id, shortname FROM mdl_course WHERE shortname = 'modulo07'
		  144 Query	SELECT * FROM mdl_context WHERE contextlevel = '50' AND instanceid = '12'
		  144 Query	SELECT * FROM mdl_enrol WHERE courseid = '12'  ORDER BY sortorder,id
		  144 Query	SELECT * FROM mdl_user_enrolments WHERE enrolid = '31' AND userid = '459'
		  144 Query	INSERT INTO mdl_user_enrolments (enrolid,status,userid,timestart,timeend,modifierid,timecreated,timemodified) VALUES('31','0','459','1398229200','0','2','1398266396','1398266396')
140423 10:19:57	  144 Query	SELECT 'x' FROM mdl_user WHERE id = '459' AND deleted = '0' LIMIT 0, 1
		  144 Query	SELECT * FROM mdl_role_assignments WHERE roleid = '5' AND contextid = '133' AND userid = '459' AND component = '' AND itemid = '0'  ORDER BY id
		  144 Query	INSERT INTO mdl_role_assignments (roleid,contextid,userid,component,itemid,timemodified,modifierid) VALUES('5','133','459','','0','1398266397','2')