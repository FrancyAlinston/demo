select eduforum from eduforum_master where forane = 

select * from member where old_id='N029436THEA'

update navadarsan.member m, navadarsan_old.educationfundaccount o set m.receipt_date = o.correct_date where m.old_id = o.FID and o.correct_date is not null

select Date, concat(year(str_to_date(substr(Date,8,2),'%y%')),'-', month(str_to_date(substr(Date,4,3),'%b')),'-',substr(Date,1,2)) from educationfundaccount where Date REGEXP '^.*[0-9]{2}-[a-z]{3}-'

update educationfundaccount set correct_date = concat(year(str_to_date(substr(Date,8,2),'%y%')),'-', month(str_to_date(substr(Date,4,3),'%b')),'-',substr(Date,1,2)) where Date REGEXP '^.*[0-9]{2}-[a-z]{3}-'

select Date, concat(substr(date,7,4),'-',substr(date,4,2),'-',substr(date,1,2)), correct_date from educationfundaccount where correct_date is null and Date REGEXP '^.*[0-9]{2}/[0-9]{2}/[0-9]{4}'

update educationfundaccount set correct_date = concat(substr(date,7,4),'-',substr(date,4,2),'-',substr(date,1,2)) where correct_date is null and Date REGEXP '^.*[0-9]{2}/[0-9]{2}/[0-9]{4}'

select Date, concat(substr(date,7,4),'-',substr(date,4,2),'-',substr(date,1,2)), correct_date from educationfundaccount where correct_date is null