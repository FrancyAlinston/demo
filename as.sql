
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `development`.`ROC` 
    AS
(SELECT
  member.share_member_id,
  email.email,
  member.permanent_address,
  nidhi_total.amount,
  member.guardian_aadhar,
  member.guardian_name,
  member.pan_card
FROM
  member
  LEFT JOIN email
    ON email.member_id = member.share_member_id
  LEFT JOIN nidhi_total
    ON nidhi_total.member_no = member.share_member_id
 WHERE member.`share_member_id` IS NOT NULL
GROUP BY member.share_member_id
ORDER BY member.share_member_id);
	

