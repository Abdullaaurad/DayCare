<!DOCTYPE html>
<html lang="en">

<head>
<title>Manager</title>
    <link rel="stylesheet" href="<?= CSS ?>/Manager/meeting.css">
    <link rel="icon" href="C:\Users\Lenovo\Desktop\Daycare front end\Assets\KIDDOVILLE_LOGO.jpg">
</head>

<body>
    <div class="popup" style="height: 450px;">
        <div class="header">
            <i class="fas fa-arrow-left"></i>
            <span>Publish Leaves</span>
        </div>
        <div class="background-image"></div>
        <form action="../Dashboard/Dashboard.html" method="post">
            <div class="form-group">
                <label for="leave-type">Leave Type <span class="required">*</span></label>
                <select id="leave-type" required>
                    <option value="">Select Leave Type</option>
                    <option>Annual Leave</option>
                    <option>Poya Leave</option>
                    <option>Independent Day</option>
                    <option>Cultural Leave</option>
                    <option>Religion Leave</option>
                </select>

                <label for="dates">Dates <span class="required">*</span></label>
                <input type="date" id="dates" value="08/14/2025" style="width:340px" required>

                <label for="about">About</label>
                <textarea id="about" placeholder="Include comments for your approver" required></textarea>
            </div>

            <div class="buttons">
                <button type="submit" onclick="history.back();" class="publish">Publish</button>
                <button type="button" style="margin-left:200px;width:85px;height:35px">Cancel</button>
            </div>
        </form>
    </div>
</body>

</html>