DELIMITER //

CREATE PROCEDURE start_exam_procedure(IN p_par_id INT)
proc_block: BEGIN
    DECLARE v_slot_id INT;
    DECLARE v_cat_id INT;
    DECLARE v_psq_id INT;
    DECLARE v_status INT;
    DECLARE v_total_selected INT DEFAULT 0;

    DECLARE v_last_time TIME DEFAULT '00:00:00';
    DECLARE v_last_que INT DEFAULT 0;

    -- Step 1: Get participant slot details
    SELECT slot_id, cat_id, psq_id, status
    INTO v_slot_id, v_cat_id, v_psq_id, v_status
    FROM participant_slot_questions_details_all
    WHERE par_id = p_par_id
    LIMIT 1;

    IF v_slot_id IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid participant ID';
    END IF;

    -- ✅ Step 1.5: Exam already submitted
    IF v_status = 2 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Exam already submitted', MYSQL_ERRNO = 504;
    END IF;

    -- Step 2: Exam already started (resume)
    IF v_status = 3 THEN
        SELECT live_exam_time, last_ple_id
        INTO v_last_time, v_last_que
        FROM participants_header_all
        WHERE par_id = p_par_id;

        SELECT ple_id, que_id, question_status, marked_ans, given_time, correct_ans
        FROM participant_live_exam_transaction_all
        WHERE par_id = p_par_id
        ORDER BY ple_id;

        SELECT q.que_id, q.que_discreption_eng, q.que_option_1_eng, q.que_option_2_eng,
               q.que_option_3_eng, q.que_option_4_eng, q.que_discreption_hindi,
               q.que_option_1_hindi, q.que_option_2_hindi, q.que_option_3_hindi, q.que_option_4_hindi,
               q.que_correct_option, q.que_weightage, q.que_marks
        FROM question_header_all q
        JOIN participant_live_exam_transaction_all plet ON q.que_id = plet.que_id
        WHERE plet.par_id = p_par_id
        ORDER BY plet.ple_id;

        LEAVE proc_block;
    END IF;

    -- Step 3: Exam not started yet (status = 1)
    IF v_status = 1 THEN
        CREATE TEMPORARY TABLE tmp_questions AS
        SELECT que_id, que_weightage, que_correct_option
        FROM question_header_all
        WHERE que_status = 1
        ORDER BY RAND()
        LIMIT 60;

        SELECT COUNT(*) INTO v_total_selected FROM tmp_questions;

        IF v_total_selected < 60 THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Not enough active questions';
        END IF;

        INSERT INTO participant_live_exam_transaction_all
            (par_id, slot_id, cat_id, psq_id, que_id, question_weight, correct_ans)
        SELECT p_par_id, v_slot_id, v_cat_id, v_psq_id, que_id, que_weightage, que_correct_option
        FROM tmp_questions;

        UPDATE participant_slot_questions_details_all 
        SET status = 3
        WHERE par_id = p_par_id;

        UPDATE participants_header_all
        SET par_exam_start_time = NOW(),
            live_exam_time = 0
        WHERE par_id = p_par_id;

        SELECT ple_id, que_id, question_status, marked_ans, given_time, correct_ans
        FROM participant_live_exam_transaction_all
        WHERE par_id = p_par_id
        ORDER BY ple_id;

        SELECT q.que_id, q.que_discreption_eng, q.que_option_1_eng, q.que_option_2_eng,
               q.que_option_3_eng, q.que_option_4_eng, q.que_discreption_hindi,
               q.que_option_1_hindi, q.que_option_2_hindi, q.que_option_3_hindi, q.que_option_4_hindi,
               q.que_correct_option, q.que_weightage, q.que_marks
        FROM question_header_all q
        JOIN participant_live_exam_transaction_all plet ON q.que_id = plet.que_id
        WHERE plet.par_id = p_par_id
        ORDER BY plet.ple_id;

        DROP TEMPORARY TABLE IF EXISTS tmp_questions;
    END IF;
END proc_block //

DELIMITER ;
