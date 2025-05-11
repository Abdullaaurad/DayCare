<?php

namespace Controller;

use App\Helpers\SidebarHelper;
use App\Helpers\FileHelper;
use DateTime;

defined('ROOTPATH') or exit('Access denied');

class Message
{
    use MainController;
    public function index()
    {
        $session = new \Core\Session;
        $session->set("CHILDID", 1);
        $session->set("USERID", 1);
        $session->check_login();

        $data = [];

        $data['chat'] = $this->store_chats();
        $data['Profile'] = $this->Profile();
        $this->view('Teacher/message', $data);
    }

    private function Profile()
    {
        $session = new \core\Session;
        $UserID = $session->get('USERID');

        $TeacherModal = new \Modal\Teacher;
        $data = $TeacherModal->first(["UserID" => 1]);
        if (!empty($data)) {
            $imageData = $data->Image;
            $imageType = $data->ImageType;
            $base64Image = (!empty($imageData) && is_string($imageData))
                ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                : null;
            $data->Image = $base64Image;
            $data->EmployeeID = 'EMP' . str_pad($data->UserID, 5, '0', STR_PAD_LEFT);
        }

        return $data;
    }

    public function get_users()
    {

        header('Content-Type: application/json');
        $request = json_decode(file_get_contents('php://input'), true);
        $ReceiverName = isset($request['Name']) ? $request['Name'] : null;

        $session = new \Core\Session;
        $assignMaidModal = new \Modal\AssignMaid;
        $assignTeacherModal = new \Modal\AssignTeacher;
        $MessageModal = new \Modal\Chat;
        $AttendanceModal = new \Modal\Attendance;
        $TeacherModal = new \Modal\Teacher;
        $MaidModal = new \Modal\Maid;
        $ChildModal = new \Modal\Child;
        $DoctorModal = new \Modal\Doctor;
        $ManagerModal = new \Modal\Manager;
        $ReceptionistModal = new \Modal\Receptionist;
        $ParentModal = new \Modal\ParentUser;
        $UserModal = new \Modal\User;

        $ChildID = $session->get("CHILDID");
        $UserID = $session->get("USERID");

        $today = new DateTime();
        $today = $today->format('Y-m-d');
        $Attended = $AttendanceModal->first(["ChildID" => $ChildID, "Start_Date" => $today]);

        $sentHistory     = $MessageModal->where_norder(["SenderID" => $ChildID]);
        $receivedHistory = $MessageModal->where_norder(["ReceiverID" => $ChildID]);

        $ChatHistory = array_merge((array)$sentHistory, (array)$receivedHistory);

        $uniqueMessages = [];
        foreach ($ChatHistory as $message) {
            $uniqueKey = $message->SenderID . "-" . $message->ReceiverID . "-" . strtotime($message->DateTime); // Unique identifier
            if (!isset($uniqueMessages[$uniqueKey])) {
                $uniqueMessages[$uniqueKey] = $message;
            }
        }

        $ChatHistory = array_values($ChatHistory);

        // Use the partner's unique UserID from the User table as the key.
        $conversations = [];

        foreach ($ChatHistory as $message) {
            // Determine the role and role-specific partner ID.
            if ($message->SenderID == $ChildID) {
                $partnerRole = $message->ReceiverRole;
                $roleSpecificPartnerID = $message->ReceiverID;
            } else {
                $partnerRole = $message->SenderRole;
                $roleSpecificPartnerID = $message->SenderID;
            }

            // Fetch partner data based on role.
            switch ($partnerRole) {
                case 'Teacher':
                    $PartnerData = $TeacherModal->first(["TeacherID" => $roleSpecificPartnerID]);
                    break;
                case 'Maid':
                    $PartnerData = $MaidModal->first(["MaidID" => $roleSpecificPartnerID]);
                    break;
                case 'Child':
                    $PartnerData = $ParentModal->first(["UserID" => $UserID]);
                    break;
                case 'Doctor':
                    $PartnerData = $DoctorModal->first(["DoctorID" => $roleSpecificPartnerID]);
                    break;
                case 'Manager':
                    $PartnerData = $ManagerModal->first(["ManagerID" => $roleSpecificPartnerID]);
                    break;
                case 'Receptionist':
                    $PartnerData = $ReceptionistModal->first(["ReceptionistID" => $roleSpecificPartnerID]);
                    break;
                default:
                    $PartnerData = null;
                    break;
            }

            // Skip if partner data isn't found.
            if (!$PartnerData) {
                continue;
            }

            // Use the partner's unique UserID from the User table.
            $partnerUserID = $PartnerData->UserID;
            $User = $UserModal->first(["UserID" => $partnerUserID]);

            // Create base64 encoded image if available.
            $imageData = $PartnerData->Image;
            $imageType = $PartnerData->ImageType;
            $base64Image = (!empty($imageData) && is_string($imageData))
                ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                : null;

            // Build conversation using partnerUserID as the key.
            if (!isset($conversations[$partnerUserID])) {
                $conversations[$partnerUserID] = [
                    'LastSeen' => date('Y-m-d H:i', strtotime($User->Date)),
                    'partnerName'      => trim($PartnerData->First_Name . ' ' . $PartnerData->Last_Name),
                    'PartnerImage'     => $base64Image,
                    'partnerUserID'    => $partnerUserID,            // Unique identifier
                    'roleSpecificID'   => $roleSpecificPartnerID,    // Role-specific ID (TeacherID, MaidID, etc.)
                    'Role'             => $partnerRole,
                    'canmessage'       => false, // Default; might be updated below.
                    'messages'         => []
                ];
            }

            // Append the current message to this conversation.
            $conversations[$partnerUserID]['messages'][] = $message;
        }

        // Sort messages within each conversation by DateTime.
        foreach ($conversations as &$conv) {
            usort($conv['messages'], function ($a, $b) {
                return strtotime($a->DateTime) - strtotime($b->DateTime);
            });
        }
        unset($conv);

        // Update conversation entries based on today's assignments.
        if ($Attended) {
            // Process assigned teachers.
            $TodayTeachers = $assignTeacherModal->where_norder(["Date" => $today]);
            foreach ($TodayTeachers as $Teacher) {
                $teacherRoleSpecificID = $Teacher->TeacherID;
                // Get the teacher's data.
                $TeacherData = $TeacherModal->first(["TeacherID" => $teacherRoleSpecificID]);
                if (!$TeacherData) continue;
                $teacherUserID = $TeacherData->UserID;

                if (isset($conversations[$teacherUserID])) {
                    $conversations[$teacherUserID]['canmessage'] = true;
                } else {
                    $User = $UserModal->first(["UserID" => $teacherUserID]);
                    $imageData = $TeacherData->Image;
                    $imageType = $TeacherData->ImageType;
                    $base64Image = (!empty($imageData) && is_string($imageData))
                        ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                        : null;

                    $conversations[$teacherUserID] = [
                        'LastSeen' => date('Y-m-d H:i', strtotime($User->Date)),
                        'partnerName'    => trim($TeacherData->First_Name . ' ' . $TeacherData->Last_Name),
                        'PartnerImage'   => $base64Image,
                        'partnerUserID'  => $teacherUserID,
                        'roleSpecificID' => $teacherRoleSpecificID,
                        'Role'           => 'Teacher',
                        'canmessage'     => true,
                        'messages'       => [] // No previous messages yet.
                    ];
                }
            }

            // Process assigned maid.
            $TodayMaid = $assignMaidModal->first(["ChildID" => $ChildID, "Date" => $today]);
            if ($TodayMaid) {
                $maidRoleSpecificID = $TodayMaid->MaidID;
                $MaidData = $MaidModal->first(["MaidID" => $maidRoleSpecificID]);
                if ($MaidData) {
                    $maidUserID = $MaidData->UserID;
                    if (isset($conversations[$maidUserID])) {
                        $conversations[$maidUserID]['canmessage'] = true;
                    } else {
                        $User = $UserModal->first(["UserID" => $maidUserID]);
                        $imageData = $MaidData->Image;
                        $imageType = $MaidData->ImageType;
                        $base64Image = (!empty($imageData) && is_string($imageData))
                            ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                            : null;

                        $conversations[$maidUserID] = [
                            'LastSeen'       => $User->Date,
                            'partnerName'    => trim($MaidData->First_Name . ' ' . $MaidData->Last_Name),
                            'PartnerImage'   => $base64Image,
                            'partnerUserID'  => $maidUserID,
                            'roleSpecificID' => $maidRoleSpecificID,
                            'Role'           => 'Maid',
                            'canmessage'     => true,
                            'messages'       => []
                        ];
                    }
                }
            }
        }

        foreach ($conversations as $partnerUserID => &$conversation) {
            // Get the latest message by DateTime (using max of the latest message's DateTime in each conversation)
            if (!empty($conversation['messages'])) {
                // Get the latest message's DateTime
                $latestMessage = end($conversation['messages']);
                $conversation['lastMessageDateTime'] = $latestMessage->DateTime; // Store it for sorting
            } else {
                // If no messages, set a default date far in the past
                $conversation['lastMessageDateTime'] = '1970-01-01 00:00:00';
            }
        }
        unset($conversation); // Avoid reference issues

        // Now, sort the conversations based on the most recent message (in descending order)
        usort($conversations, function ($a, $b) {
            // Prioritize "canmessage" (true should be at the top)
            if ($a['canmessage'] !== $b['canmessage']) {
                return $b['canmessage'] - $a['canmessage']; // true (1) comes first, false (0) later
            }

            // If "canmessage" is the same, sort by lastMessageDateTime in descending order
            return strtotime($b['lastMessageDateTime']) - strtotime($a['lastMessageDateTime']);
        });

        if (isset($ReceiverName) && !empty($ReceiverName)) {
            // Filter conversations where partner name contains the search term (case-insensitive)
            $filteredConversations = array_filter($conversations, function ($conversation) use ($ReceiverName) {
                return stripos($conversation['partnerName'], $ReceiverName) !== false;
            });

            // Use the filtered results if any matches were found
            if (!empty($filteredConversations)) {
                $conversations = array_values($filteredConversations); // Reset array keys
            }
        }

        if (isset($conversations)) {
            $response = ['success' => true, 'message' => $conversations];
        } else {
            $response = ['success' => false, 'message' => 'No User to display'];
        }

        echo json_encode($response);
    }

    public function NewMessage()
    {
        header('Content-Type: application/json');

        $request = json_decode(file_get_contents('php://input'), true);
        $UserID = $request['UserID'];

        $session = new \Core\Session;
        $MessageModal = new \Modal\Chat;
        $UserModal = new \Modal\User;

        // Get current user and child ID
        $User = $UserModal->first(["UserID" => $UserID]);
        $ChildID = $session->get("CHILDID");

        if (!$ChildID) {
            echo json_encode(['success' => false, 'message' => 'No child ID found in session.']);
            return;
        }

        // Fetch all messages TO this ChildID that are unseen
        $newMessages = $MessageModal->where_norder([
            "SenderID" => $UserID,
            "SenderRole" => $User->Role,
            "ReceiverID" => $ChildID,
            "ReceiverRole" => "Child",
            "Seen" => 0
        ]);

        // Mark them as seen
        if (!empty($newMessages)) {
            foreach ($newMessages as $msg) {
                $MessageModal->update(["ChatID" => $msg->ChatID], ["Seen" => 1]);
            }
        }

        // Sort by time
        if (!empty($newMessages)) {
            usort($newMessages, function ($a, $b) {
                return strtotime($a->DateTime) - strtotime($b->DateTime);
            });
        }

        $response = [
            'success' => true,
            'message' => $newMessages ?? []
        ];

        echo json_encode($response);
    }

    public function get_messages()
    {
        header('Content-Type: application/json');
        $request = json_decode(file_get_contents('php://input'), true);
        $UserID = $request['UserID'];

        $session = new \Core\Session;
        $MessageModal = new \Modal\Chat;
        $AttendanceModal = new \Modal\Attendance;
        $TeacherModal = new \Modal\Teacher;
        $MaidModal = new \Modal\Maid;
        $ChildModal = new \Modal\Child;
        $DoctorModal = new \Modal\Doctor;
        $ManagerModal = new \Modal\Manager;
        $ReceptionistModal = new \Modal\Receptionist;
        $UserModal = new \Modal\User;
        $ParentModal = new \Modal\ParentUser;

        $User = $UserModal->first(["UserID" => $UserID]);
        $ChildID  = $session->get("CHILDID");

        switch ($User->Role) {
            case 'Teacher':
                $PartnerData = $TeacherModal->first(["UserID" => $UserID]);
                $PartnerID = $PartnerData->TeacherID;
                $sentHistory     = $MessageModal->where_norder(["SenderID" => $ChildID, "ReceiverID" => $PartnerID, "SenderRole" => "Child",  "ReceiverRole" => "Teacher"]);
                $receivedHistory = $MessageModal->where_norder(["ReceiverID" => $ChildID, "SenderID" => $PartnerID, "ReceiverRole" => "Child", "SenderRole" => "Teacher"]);

                if (!empty($receivedHistory)) {
                    foreach ($receivedHistory as $his) {
                        $MessageModal->update(["ChatID" => $his->ChatID], ["Seen" => 1]);
                    }
                }

                $ChatHistory = array_merge((array)$sentHistory, (array)$receivedHistory);
                $ChatHistory = array_filter($ChatHistory, fn($message) => $message !== false);
                break;
            case 'Maid':
                $PartnerData = $MaidModal->first(["UserID" => $UserID]);
                $PartnerID = $PartnerData->MaidID;

                $sentHistory     = $MessageModal->where_norder(["SenderID" => $ChildID, "ReceiverID" => $PartnerID, "SenderRole" => "Child",  "ReceiverRole" => "Maid"]);
                $receivedHistory = $MessageModal->where_norder(["ReceiverID" => $ChildID, "SenderID" => $PartnerID, "ReceiverRole" => "Child", "SenderRole" => "Maid"]);

                if (!empty($receivedHistory)) {
                    foreach ($receivedHistory as $his) {
                        $MessageModal->update(["ChatID" => $his->ChatID], ["Seen" => 1]);
                    }
                }

                $ChatHistory = array_merge((array)$sentHistory, (array)$receivedHistory);
                $ChatHistory = array_filter($ChatHistory, fn($message) => $message !== false);
                break;
            case 'Child':
                $PartnerData = $ParentModal->first(["UserID" => $UserID]);
                $PartnerID = $PartnerData->ChildID;
                $sentHistory     = $MessageModal->where_norder(["SenderID" => $PartnerID, "SenderRole" => "Child"]);
                $receivedHistory = $MessageModal->where_norder(["ReceiverID" => $PartnerID, "ReceiverRole" => "Child"]);

                if (!empty($receivedHistory)) {
                    foreach ($receivedHistory as $his) {
                        $MessageModal->update(["ChatID" => $his->ChatID], ["Seen" => 1]);
                    }
                }

                $ChatHistory = array_merge((array)$sentHistory, (array)$receivedHistory);
                $ChatHistory = array_filter($ChatHistory, fn($message) => $message !== false);
                break;
            case 'Doctor':
                $PartnerData = $DoctorModal->first(["UserID" => $UserID]);
                $PartnerID = $PartnerData->DoctorID;
                $sentHistory     = $MessageModal->where_norder(["SenderID" => $ChildID, "ReceiverID" => $PartnerID, "SenderRole" => "Child",  "ReceiverRole" => "Doctor"]);
                $receivedHistory = $MessageModal->where_norder(["ReceiverID" => $ChildID, "SenderID" => $PartnerID, "ReceiverRole" => "Child", "SenderRole" => "Doctor"]);

                if (!empty($receivedHistory)) {
                    foreach ($receivedHistory as $his) {
                        $MessageModal->update(["ChatID" => $his->ChatID], ["Seen" => 1]);
                    }
                }

                $ChatHistory = array_merge((array)$sentHistory, (array)$receivedHistory);
                $ChatHistory = array_filter($ChatHistory, fn($message) => $message !== false);
                break;
            case 'Manager':
                $PartnerData = $ManagerModal->first(["UserID" => $UserID]);
                $PartnerID = $PartnerData->ManagerID;
                $sentHistory     = $MessageModal->where_norder(["SenderID" => $ChildID, "ReceiverID" => $PartnerID, "SenderRole" => "Child",  "ReceiverRole" => "Manager"]);
                $receivedHistory = $MessageModal->where_norder(["ReceiverID" => $ChildID, "SenderID" => $PartnerID, "ReceiverRole" => "Child", "SenderRole" => "Manager"]);

                if (!empty($receivedHistory)) {
                    foreach ($receivedHistory as $his) {
                        $MessageModal->update(["ChatID" => $his->ChatID], ["Seen" => 1]);
                    }
                }

                $ChatHistory = array_merge((array)$sentHistory, (array)$receivedHistory);
                $ChatHistory = array_filter($ChatHistory, fn($message) => $message !== false);
                break;
            case 'Receptionist':
                $PartnerData = $ReceptionistModal->first(["UserID" => $UserID]);
                $PartnerID = $PartnerData->ReceptionistID;
                $sentHistory     = $MessageModal->where_norder(["SenderID" => $ChildID, "ReceiverID" => $PartnerID, "SenderRole" => "Child",  "ReceiverRole" => "Receptionist"]);
                $receivedHistory = $MessageModal->where_norder(["ReceiverID" => $ChildID, "SenderID" => $PartnerID, "ReceiverRole" => "Child", "SenderRole" => "Receptionist"]);

                if (!empty($receivedHistory)) {
                    foreach ($receivedHistory as $his) {
                        $MessageModal->update(["ChatID" => $his->ChatID], ["Seen" => 1]);
                    }
                }

                $ChatHistory = array_merge((array)$sentHistory, (array)$receivedHistory);
                $ChatHistory = array_filter($ChatHistory, fn($message) => $message !== false);
                break;
            default:
                $PartnerData = null;
                break;
        }

        // $ChatHistory = array_values($uniqueMessages);
        if (!empty($ChatHistory)) {
            usort($ChatHistory, function ($a, $b) {
                return strtotime($a->DateTime) - strtotime($b->DateTime);
            });
        }

        if (isset($ChatHistory) && !empty($ChatHistory)) {
            $response = ['success' => true, 'message' => $ChatHistory];
        } elseif (isset($ChatHistory)) {
            // No messages found, but it's still a successful response
            $response = ['success' => true, 'message' => []];
        } else {
            // An actual error occurred (e.g., failed query, invalid user)
            $response = ['success' => false, 'message' => 'An error occurred while fetching messages.'];
        }

        echo json_encode($response);
    }

    public function store_chats()
    {
        $session = new \Core\Session;
        $assignMaidModal = new \Modal\AssignMaid;
        $assignTeacherModal = new \Modal\AssignTeacher;
        $MessageModal = new \Modal\Chat;
        $AttendanceModal = new \Modal\Attendance;
        $TeacherModal = new \Modal\Teacher;
        $MaidModal = new \Modal\Maid;
        $ChildModal = new \Modal\Child;
        $DoctorModal = new \Modal\Doctor;
        $ManagerModal = new \Modal\Manager;
        $ReceptionistModal = new \Modal\Receptionist;
        $ParentModal = new \Modal\ParentUser;
        $UserModal = new \Modal\User;

        $ChildID = $session->get("CHILDID");
        $UserID = $session->get("USERID");

        $today = new DateTime();
        $today = $today->format('Y-m-d');
        $Attended = $AttendanceModal->first(["ChildID" => $ChildID, "Start_Date" => $today]);

        $sentHistory     = $MessageModal->where_norder(["SenderID" => $ChildID]);
        $receivedHistory = $MessageModal->where_norder(["ReceiverID" => $ChildID]);

        $ChatHistory = array_merge((array)$sentHistory, (array)$receivedHistory);

        // Ensure uniqueness using array_map and array_unique with a custom key
        $uniqueMessages = [];
        foreach ($ChatHistory as $message) {
            $uniqueKey = $message->SenderID . "-" . $message->ReceiverID . "-" . strtotime($message->DateTime); // Unique identifier
            if (!isset($uniqueMessages[$uniqueKey])) {
                $uniqueMessages[$uniqueKey] = $message;
            }
        }

        $ChatHistory = array_values($uniqueMessages);

        // Use the partner's unique UserID from the User table as the key.
        $conversations = [];

        foreach ($ChatHistory as $message) {
            // Determine the role and role-specific partner ID.
            if ($message->SenderID == $ChildID) {
                $partnerRole = $message->ReceiverRole;
                $roleSpecificPartnerID = $message->ReceiverID;
            } else {
                $partnerRole = $message->SenderRole;
                $roleSpecificPartnerID = $message->SenderID;
            }

            // Fetch partner data based on role.
            switch ($partnerRole) {
                case 'Teacher':
                    $PartnerData = $TeacherModal->first(["TeacherID" => $roleSpecificPartnerID]);
                    break;
                case 'Maid':
                    $PartnerData = $MaidModal->first(["MaidID" => $roleSpecificPartnerID]);
                    break;
                case 'Child':
                    $PartnerData = $ParentModal->first(["UserID" => $UserID]);
                    break;
                case 'Doctor':
                    $PartnerData = $DoctorModal->first(["DoctorID" => $roleSpecificPartnerID]);
                    break;
                case 'Manager':
                    $PartnerData = $ManagerModal->first(["ManagerID" => $roleSpecificPartnerID]);
                    break;
                case 'Receptionist':
                    $PartnerData = $ReceptionistModal->first(["ReceptionistID" => $roleSpecificPartnerID]);
                    break;
                default:
                    $PartnerData = null;
                    break;
            }

            // Skip if partner data isn't found.
            if (!$PartnerData) {
                continue;
            }

            // Use the partner's unique UserID from the User table.
            $partnerUserID = $PartnerData->UserID;
            $User = $UserModal->first(["UserID" => $partnerUserID]);

            // Create base64 encoded image if available.
            $imageData = $PartnerData->Image;
            $imageType = $PartnerData->ImageType;
            $base64Image = (!empty($imageData) && is_string($imageData))
                ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                : null;

            // Build conversation using partnerUserID as the key.
            if (!isset($conversations[$partnerUserID])) {
                $conversations[$partnerUserID] = [
                    'LastSeen' => date('Y-m-d H:i', strtotime($User->Date)),
                    'partnerName'      => trim($PartnerData->First_Name . ' ' . $PartnerData->Last_Name),
                    'PartnerImage'     => $base64Image,
                    'partnerUserID'    => $partnerUserID,            // Unique identifier
                    'roleSpecificID'   => $roleSpecificPartnerID,    // Role-specific ID (TeacherID, MaidID, etc.)
                    'Role'             => $partnerRole,
                    'canmessage'       => false, // Default; might be updated below.
                    'messages'         => []
                ];
            }

            // Append the current message to this conversation.
            $conversations[$partnerUserID]['messages'][] = $message;
        }

        // Sort messages within each conversation by DateTime.
        foreach ($conversations as &$conv) {
            usort($conv['messages'], function ($a, $b) {
                return strtotime($a->DateTime) - strtotime($b->DateTime);
            });
        }
        unset($conv);

        // Update conversation entries based on today's assignments.
        if ($Attended) {
            // Process assigned teachers.
            $TodayTeachers = $assignTeacherModal->where_norder(["Date" => $today]);
            foreach ($TodayTeachers as $Teacher) {
                $teacherRoleSpecificID = $Teacher->TeacherID;
                // Get the teacher's data.
                $TeacherData = $TeacherModal->first(["TeacherID" => $teacherRoleSpecificID]);
                if (!$TeacherData) continue;
                $teacherUserID = $TeacherData->UserID;

                if (isset($conversations[$teacherUserID])) {
                    $conversations[$teacherUserID]['canmessage'] = true;
                } else {
                    $User = $UserModal->first(["UserID" => $teacherUserID]);
                    $imageData = $TeacherData->Image;
                    $imageType = $TeacherData->ImageType;
                    $base64Image = (!empty($imageData) && is_string($imageData))
                        ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                        : null;

                    $conversations[$teacherUserID] = [
                        'LastSeen' => date('Y-m-d H:i', strtotime($User->Date)),
                        'partnerName'    => trim($TeacherData->First_Name . ' ' . $TeacherData->Last_Name),
                        'PartnerImage'   => $base64Image,
                        'partnerUserID'  => $teacherUserID,
                        'roleSpecificID' => $teacherRoleSpecificID,
                        'Role'           => 'Teacher',
                        'canmessage'     => true,
                        'messages'       => [] // No previous messages yet.
                    ];
                }
            }

            // Process assigned maid.
            $TodayMaid = $assignMaidModal->first(["ChildID" => $ChildID, "Date" => $today]);
            if ($TodayMaid) {
                $maidRoleSpecificID = $TodayMaid->MaidID;
                $MaidData = $MaidModal->first(["MaidID" => $maidRoleSpecificID]);
                if ($MaidData) {
                    $maidUserID = $MaidData->UserID;
                    if (isset($conversations[$maidUserID])) {
                        $conversations[$maidUserID]['canmessage'] = true;
                    } else {
                        $User = $UserModal->first(["UserID" => $maidUserID]);
                        $imageData = $MaidData->Image;
                        $imageType = $MaidData->ImageType;
                        $base64Image = (!empty($imageData) && is_string($imageData))
                            ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                            : null;

                        $conversations[$maidUserID] = [
                            'LastSeen'       => $User->Date,
                            'partnerName'    => trim($MaidData->First_Name . ' ' . $MaidData->Last_Name),
                            'PartnerImage'   => $base64Image,
                            'partnerUserID'  => $maidUserID,
                            'roleSpecificID' => $maidRoleSpecificID,
                            'Role'           => 'Maid',
                            'canmessage'     => true,
                            'messages'       => []
                        ];
                    }
                }
            }
        }
        return $conversations;
    }

    public function setchildsession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        header('Content-Type: application/json');
        $request = json_decode(file_get_contents('php://input'), true);
        $response = [];

        $session = new \Core\Session;
        if (isset($request['ChildID'])) {
            $session->set('CHILDID', $request['ChildID']);
            $response = ['success' => true, 'message' => 'Child session removed.'];
        } else {
            $response = ['success' => false, 'message' => 'No child session to remove.'];
        }

        echo json_encode($response);
        exit();
    }

    public function insert_message()
    {
        $UserModal = new \Modal\User;
        $MessageModal = new \Modal\Chat;
        $TeacherModal = new \Modal\Teacher;
        $MaidModal = new \Modal\Maid;
        $ChildModal = new \Modal\Child;
        $DoctorModal = new \Modal\Doctor;
        $ManagerModal = new \Modal\Manager;
        $ReceptionistModal = new \Modal\Receptionist;
        $ParentModal = new \Modal\ParentUser;

        header('Content-Type: application/json');
        $request = json_decode(file_get_contents('php://input'), true);

        // Check if the expected key exists
        if (isset($request['ChildID'])) {
            // Retrieve the input data
            $ChildID    = $request['ChildID'];
            $ReceiverID = $request['ReceiverID'] ?? null;
            $Message    = $request['Message'] ?? null;
            $Image = $request['Image'] ?? null;

            // Create a timestamp for DateTime
            $now = new DateTime();
            $DateTime = $now->format('Y-m-d H:i:s');
            $SenderRole = "Child";

            // Fetch the receiver's role from the user model
            $user = $UserModal->first(["UserID" => $ReceiverID]);
            $ReceiverRole = $user->Role ?? "Unknown";

            switch ($ReceiverRole) {
                case 'Teacher':
                    $PartnerData = $TeacherModal->first(["UserID" => $ReceiverID]);
                    $ReceiverID = $PartnerData->TeacherID;
                    break;
                case 'Maid':
                    $PartnerData = $MaidModal->first(["UserID" => $ReceiverID]);
                    $ReceiverID = $PartnerData->MaidID;
                    break;
                // case 'Child':
                //     $PartnerData = $ParentModal->first(["UserID" => $UserID]);
                //     break;
                case 'Doctor':
                    $PartnerData = $DoctorModal->first(["UserID" => $ReceiverID]);
                    $ReceiverID = $PartnerData->DoctorID;
                    break;
                case 'Manager':
                    $PartnerData = $ManagerModal->first(["UserID" => $ReceiverID]);
                    $ReceiverID = $PartnerData->ManagerID;
                    break;
                case 'Receptionist':
                    $PartnerData = $ReceptionistModal->first(["UserID" => $ReceiverID]);
                    $ReceiverID = $PartnerData->ReceptionistID;
                    break;
                default:
                    $PartnerData = 3;
                    break;
            }

            $data = [
                'SenderID'     => $ChildID,
                'ReceiverID'   => $ReceiverID,
                'Message'      => $Message,
                'SenderRole'   => $SenderRole,
                'ReceiverRole' => $ReceiverRole,
                'DateTime'     => $DateTime,
            ];

            $inserted = $MessageModal->insert($data);

            if ($inserted) {
                $response = [
                    'success' => true,
                    'message' => 'Message inserted successfully.',
                    'data'    => $data
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to insert message.'
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'No ChildID found in the request.'
            ];
        }
        echo json_encode($response);
    }

    public function uploadFiles()
    {
        $UserModal = new \Modal\User;
        $MessageModal = new \Modal\Chat;
        $TeacherModal = new \Modal\Teacher;
        $MaidModal = new \Modal\Maid;
        $ChildModal = new \Modal\Child;
        $DoctorModal = new \Modal\Doctor;
        $ManagerModal = new \Modal\Manager;
        $ReceptionistModal = new \Modal\Receptionist;
        $ParentModal = new \Modal\ParentUser;
        $FileHelper = new FileHelper;

        // Check if files are uploaded
        if (isset($_FILES['files']) && !empty($_FILES['files']['name'][0])) {
            $uploadedFiles = [];

            $ChildID = $_POST['ChildID'] ?? null;
            $ReceiverID = $_POST['ReceiverID'] ?? null;

            // Fetch receiver's role **before** the loop
            $user = $UserModal->first(["UserID" => $ReceiverID]);
            $ReceiverRole = $user->Role ?? "Unknown";

            switch ($ReceiverRole) {
                case 'Teacher':
                    $PartnerData = $TeacherModal->first(["UserID" => $ReceiverID]);
                    $ReceiverID = $PartnerData->TeacherID ?? $ReceiverID;
                    break;
                case 'Maid':
                    $PartnerData = $MaidModal->first(["UserID" => $ReceiverID]);
                    $ReceiverID = $PartnerData->MaidID ?? $ReceiverID;
                    break;
                case 'Doctor':
                    $PartnerData = $DoctorModal->first(["UserID" => $ReceiverID]);
                    $ReceiverID = $PartnerData->DoctorID ?? $ReceiverID;
                    break;
                case 'Manager':
                    $PartnerData = $ManagerModal->first(["UserID" => $ReceiverID]);
                    $ReceiverID = $PartnerData->ManagerID ?? $ReceiverID;
                    break;
                case 'Receptionist':
                    $PartnerData = $ReceptionistModal->first(["UserID" => $ReceiverID]);
                    $ReceiverID = $PartnerData->ReceptionistID ?? $ReceiverID;
                    break;
                default:
                    break;
            }

            $now = new DateTime();
            $DateTime = $now->format('Y-m-d H:i:s');
            $SenderRole = "Child";

            //     // Loop through the uploaded files
            foreach ($_FILES['files']['name'] as $key => $fileName) {
                //Store the file
                $fileData = $FileHelper->store_file([
                    'name'     => $_FILES['files']['name'][$key],
                    'type'     => $_FILES['files']['type'][$key],
                    'tmp_name' => $_FILES['files']['tmp_name'][$key],
                    'error'    => $_FILES['files']['error'][$key],
                    'size'     => $_FILES['files']['size'][$key]
                ], 'Messager');

                if (!$fileData) {
                    continue; // Skip if upload failed
                }

                //Get file URL & type
                $fileURL = $fileData['url'] ?? null;
                $fileName = $fileData['name'] ?? null;
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $fileType = $this->getFileType($fileExtension);

                // Prepare data to insert into the MessageModal
                $insertData = [
                    'SenderID'     => $ChildID,
                    'ReceiverID'   => $ReceiverID, // Now it's constant
                    'URL'          => $fileURL,
                    'FileType'     => $fileType,
                    'FileName'     => $fileName,
                    'SenderRole'   => $SenderRole,
                    'ReceiverRole' => $ReceiverRole,
                    'DateTime'     => $DateTime,
                ];

                //Insert the data into the MessageModal
                $MessageModal->insert($insertData);

                // Store the file info in the uploadedFiles array (for response)
                $uploadedFiles[] = $fileData;
            }

            // Return JSON response
            echo json_encode([
                'success' => true,
                'files' => $uploadedFiles,
                'data' => [
                    'ChildID' => $ChildID,
                    'ReceiverID' => $ReceiverID,
                    'ReceiverRole' => $ReceiverRole
                ]
            ]);
        } else {
            // No files uploaded
            echo json_encode([
                'success' => false,
                'message' => 'No files uploaded.'
            ]);
        }
    }

    private function getFileType($fileExtension)
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $videoExtensions = ['mp4', 'avi', 'mov', 'mkv'];
        $audioExtensions = ['mp3', 'wav', 'ogg'];
        $documentExtensions = ['pdf', 'docx', 'txt', 'html', 'cpp', 'xlsx', 'ppt'];

        // Convert extension to lowercase
        $fileExtension = strtolower($fileExtension);

        // Check if the file extension matches known image extensions
        if (in_array($fileExtension, $imageExtensions)) {
            return 'image';
        }

        // Check if the file extension matches known video extensions
        if (in_array($fileExtension, $videoExtensions)) {
            return 'video';
        }

        // Check if the file extension matches known audio extensions
        if (in_array($fileExtension, $audioExtensions)) {
            return 'audio';
        }

        // Check if the file extension matches known document extensions
        if (in_array($fileExtension, $documentExtensions)) {
            return 'document';
        }

        // If no match found, return the extension itself (in case it's not handled)
        return $fileExtension;
    }

    public function deletechat()
    {
        header('Content-Type: application/json');
        $request = json_decode(file_get_contents('php://input'), true);

        $ChatID = $request['ChatID'];

        $ChatModal = new \Modal\Chat;
        $ChatModal->update(["ChatID" => $ChatID], ["Deleted" => true]);

        $response = [
            'success' => true,
            'message' => 'Message deleted successfully.',
        ];

        echo json_encode($response);
    }

    public function editchat()
    {
        header('Content-Type: application/json');
        $request = json_decode(file_get_contents('php://input'), true);

        $ChatID = $request['ChatID'];
        $Message = $request['Message'];

        $ChatModal = new \Modal\Chat;
        $ChatModal->update(["ChatID" => $ChatID], ["Edited" => true, "Message" => $Message]);

        $response = [
            'success' => true,
            'message' => 'Message deleted successfully.',
        ];

        echo json_encode($response);
    }

    public function Logout()
    {
        $session = new \core\Session();
        $session->logout();

        echo json_encode(["success" => true]);
        exit;
    }
}
