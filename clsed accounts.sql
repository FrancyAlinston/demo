select * from member where old_id like '%36766POTY'

update member set status = 'closed' where old_id in (select nes_id from closed_accounts)

create table tempclosed select distinct * from closed_accounts; 

drop table closed_accounts;

rename table tempclosed to closed_accounts

select old_id , status from member where old_id in (select nes_id from closed_accounts)





