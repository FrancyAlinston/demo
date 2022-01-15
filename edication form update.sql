select m.education_forum, e.forane from member m, eduforum_master e where m.education_forum = e.eduforum

update member m, eduforum_master e set m.forane = e.forane where m.education_forum = e.eduforum

update member m, forane_master f set m.forane = concat(f.id,'|', f.forane) where m.forane = f.id and m.forane is not null

select distinct education_forum  from member where forane is null order by education_forum

update member set education_forum = 'vaduthala-donbosco' where education_forum = 'don bosco vaduthala'

update member set education_forum = 'gandhinagar' where education_forum = 'kaloor st. sebastian'

update member set education_forum = 'kaloor (a)' where education_forum = 'kaloor st. antony'

update member set education_forum = 'kaloor (b)' where education_forum = 'kaloor b'

update member set education_forum = 'edayakunnam' where education_forum = 'edayakkunnam'

update member set education_forum = 'chowara' where education_forum = 'chovara'