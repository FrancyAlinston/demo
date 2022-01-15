select * from corpus_transactions where ledger_name in (select donor from corpus_fund)

update corpus_transactions t, corpus_fund c set t.corp_id = c.id where t.ledger_name = c.donor

select * from corpus_transactions where corp_id = 1983


select corp_id, count(ledger_name), ledger_name from corpus_transactions where corp_id is not null group by ledger_name order by corp_id

select * from member where old_id like '%37023%'

select voucher_number,transaction_date,narration,ledger_name,amount from corpus_transactions 